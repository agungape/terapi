<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Terapis;
use App\Models\Informasi;
use App\Models\Kunjungan;
use App\Models\Tarif;
use App\Models\Assessment;
use Illuminate\Support\Str;
use Milon\Barcode\DNS2D;

class MobileNewController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $anak = $user->getAnakData();
        
        if (!$anak) {
            return redirect()->route('login')->with('error', 'Data anak tidak ditemukan.');
        }

        $profile = \App\Models\Profile::first();

        // Fetch actual data from database
        $kunjungan = Kunjungan::where('anak_id', $anak->id)
            ->with(['terapis', 'pemeriksaans', 'fisioterapis'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch all package purchases
        $pemasukkans = \App\Models\Pemasukkan::where('anak_id', $anak->id)
            ->where('jenis_layanan', 'paket_terapi')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Filter to only active packages (remaining sessions > 0)
        $activePackages = $pemasukkans->filter(function($p) {
            $sisa = $p->sisa_pertemuan;
            if (is_array($sisa)) {
                return ($sisa['perilaku'] ?? 0) > 0 || ($sisa['fisioterapi'] ?? 0) > 0;
            }
            return $sisa > 0;
        });

        // For attendance card, pick the latest active one
        $latestPemasukkan = $activePackages ? $activePackages->first() : null;

        $attendanceKunjungan = $kunjungan;
        $totalPertemuan = 20; // Default fallback

        if ($latestPemasukkan) {
            $attendanceKunjungan = $kunjungan->where('pemasukkan_id', $latestPemasukkan->id);
            $totalPertemuan = $latestPemasukkan->tarif->jumlah_pertemuan ?? 20;
        } else {
            // Fallback if no active package found
            $latestPemasukkan = $pemasukkans ? $pemasukkans->first() : null;
            if ($latestPemasukkan) {
                $attendanceKunjungan = $kunjungan->where('pemasukkan_id', $latestPemasukkan->id);
                $totalPertemuan = $latestPemasukkan->tarif->jumlah_pertemuan ?? 20;
            }
        }

        // Map and Group sessions for Buku Anak (Hanya yang Hadir)
        // Dikelompokkan berdasarkan Sesi dan Jenis Terapi agar filter lebih akurat
        $groupedSessions = $kunjungan->where('status', 'hadir')
            ->groupBy(function($item) {
                return $item->sesi . '-' . $item->jenis_terapi;
            })
            ->map(function($group) {
                $first = $group->first();
                return [
                    'sesi_id' => $first->sesi,
                    'type' => $first->jenis_terapi,
                    'type_label' => ucfirst(str_replace('_', ' ', $first->jenis_terapi)),
                    'items' => $group->map(function($k) {
                        $programs = [];
                        $extraInfo = [];

                        if ($k->jenis_terapi === 'terapi_perilaku' || $k->jenis_terapi === 'terapi_wicara') {
                            $programs = $k->pemeriksaans->map(function($p) {
                                return [
                                    'name' => $p->program->deskripsi ?? 'Program',
                                    'status' => $p->status,
                                    'note' => $p->keterangan
                                ];
                            });
                            $extraInfo['catatan_ortu'] = $k->pemeriksaans->first()->catatan_orang_tua ?? null;
                        } else {
                            $programs = $k->fisioterapis->map(function($f) {
                                return [
                                    'name' => $f->program->deskripsi ?? 'Program',
                                    'activity' => $f->aktivitas_terapi,
                                    'note' => $f->evaluasi
                                ];
                            });
                            $firstFisio = $k->fisioterapis->first();
                            if ($firstFisio) {
                                // Untuk Fisio, biasanya catatan_khusus digunakan untuk ortu jika tidak ada kolom spesifik
                                $extraInfo['catatan_ortu'] = $firstFisio->catatan_khusus;
                            }
                        }

                        return [
                            'id' => $k->id,
                            'type' => $k->jenis_terapi,
                            'type_label' => ucfirst(str_replace('_', ' ', $k->jenis_terapi)),
                            'date' => $k->created_at->translatedFormat('d M Y'),
                            'iso_date' => $k->created_at->format('Y-m-d'),
                            'time' => $k->created_at->format('H:i'),
                            'therapist' => $k->terapis->nama ?? 'Terapis',
                            'therapist_pendamping' => $k->terapisPendamping->nama ?? null,
                            'status_sesi' => $k->status_sesi,
                            'status_absen' => $k->status,
                            'pertemuan' => $k->pertemuan,
                            'sesi' => $k->sesi,
                            'programs' => $programs,
                            'extra' => $extraInfo,
                            'catatan_umum' => $k->catatan
                        ];
                    })->values()
                ];
            })->sortBy([
                ['type', 'asc'],
                ['sesi_id', 'desc']
            ])->values();

        // Pass grouped sessions to frontend
        $sessions = $groupedSessions;

        // Pass grouped sessions to frontend
        $sessions = $groupedSessions;

        // Map data for activities (Recent Activities) - Khusus 2 Terakhir (Hadir & Perilaku/Fisio)
        $activities = $kunjungan->where('status', 'hadir')
            ->whereIn('jenis_terapi', ['terapi_perilaku', 'fisioterapi'])
            ->take(2)
            ->map(function($k) {
                $pemeriksaan = $k->pemeriksaans ? $k->pemeriksaans->first() : null;
                $fisio = $k->fisioterapis ? $k->fisioterapis->first() : null;
                
                $hasil = ($pemeriksaan->hasil_kegiatan ?? null) ?: ($fisio->hasil_kegiatan ?? null);

                $colorMap = [
                    'terapi_perilaku' => 'green',
                    'fisioterapi' => 'blue',
                ];
                $color = $colorMap[$k->jenis_terapi] ?? 'indigo';

                return [
                    'id' => $k->id,
                    'title' => 'Terapi ' . ucfirst(str_replace('_', ' ', $k->jenis_terapi)),
                    'status' => 'Hadir',
                    'rawStatus' => 'hadir',
                    'hasil' => $hasil, // baik, cukup, kurang
                    'therapist' => $k->terapis->nama ?? 'Terapis',
                    'time' => $k->created_at->diffForHumans(),
                    'color' => $color,
                    'liked' => false
                ];
            });

        // Grouped Attendance Data by Package
        $packageStats = $activePackages->map(function($pkg) use ($kunjungan) {
            $pkgKunjungan = $kunjungan->where('pemasukkan_id', $pkg->id);
            
            $hadir = $pkgKunjungan->where('status', 'hadir')->count();
            $izin = $pkgKunjungan->where('status', 'izin')->count();
            $sakit = $pkgKunjungan->where('status', 'sakit')->count();
            $hangus = $pkgKunjungan->where('status', 'izin_hangus')->count();
            
            return [
                'id' => $pkg->id,
                'name' => $pkg->tarif->nama ?? 'Paket Terapi',
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'hangus' => $hangus,
                'totalUsed' => ($hadir + $hangus),
                'totalQuota' => $pkg->tarif->jumlah_pertemuan ?? 0,
                'history' => $pkgKunjungan->map(function($k) {
                    return [
                        'id' => $k->id,
                        'isoDate' => $k->created_at->format('Y-m-d'),
                        'day' => $k->created_at->translatedFormat('l'),
                        'date' => $k->created_at->format('d M Y'),
                        'type' => 'Terapi ' . ucfirst(str_replace('_', ' ', $k->jenis_terapi)),
                        'status' => $k->status === 'hadir' ? 'Hadir' : 
                                   ($k->status === 'izin_hangus' ? 'Hangus' : 
                                   ($k->status === 'izin' || $k->status === 'sakit' ? 'Izin' : ucfirst($k->status))),
                        'rawStatus' => $k->status,
                        'mood' => 'happy',
                        'therapist' => $k->terapis->nama ?? '-',
                        'timeIn' => $k->created_at->format('H:i'),
                        'timeOut' => $k->created_at->addHour()->format('H:i')
                    ];
                })->sortByDesc('isoDate')->values()
            ];
        })->values();

        // Default stats for summary
        $attendanceStats = [
            'packages' => $packageStats ?? collect([]),
            'defaultPackageId' => ($packageStats && $packageStats->isNotEmpty()) ? ($packageStats->first()['id'] ?? null) : null
        ];

        // Statistics Calculations (RESTORED)
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $sesiMingguIni = $kunjungan->where('status', 'hadir')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->count();
            
        // Calculate Aggregate Package Progress across all active packages
        $totalPertemuanSum = 0;
        $sudahTerpakaiSum = 0;
        
        if ($activePackages->count() > 0) {
            foreach ($activePackages as $pkg) {
                $totalPertemuanSum += $pkg->tarif->jumlah_pertemuan ?? 0;
                $sudahTerpakaiSum += $pkg->sudah_terpakai;
            }
        }

        if ($totalPertemuanSum > 0) {
            $progress = round(($sudahTerpakaiSum / $totalPertemuanSum) * 100) . '%';
        } else {
            $progress = '0%';
        }

        $anakIds = \App\Models\Anak::where('nama', $anak->nama)->pluck('id');

        // Tagihan / Invoices (Strictly from Pemasukkan table)
        $tagihanCount = 0;

        $invoices = \App\Models\Pemasukkan::whereIn('anak_id', $anakIds)
            ->orWhere(function($query) use ($anak) {
                $query->whereNull('anak_id')
                      ->where('deskripsi', 'LIKE', '%' . $anak->nama . '%');
            })
            ->with('Tarif')
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function($p) {
                $packageName = $p->Tarif ? $p->Tarif->nama : null;
                $isAssessment = ($p->Tarif && $p->Tarif->jenis_terapi === 'assessment') || ($p->jenis_layanan === 'assessment');
                
                $desc = $isAssessment 
                    ? ($packageName ? 'Assessment: ' . $packageName : 'Biaya Assessment Psikologi')
                    : ($packageName ? 'Paket: ' . $packageName : ($p->deskripsi ?? 'Pembayaran Paket Terapi'));

                return [
                    'id' => 'INV-PAY-' . $p->id,
                    'db_id' => $p->id,
                    'date' => $p->tanggal ? $p->tanggal->format('d M Y') : '-',
                    'dueDate' => $p->tanggal ? $p->tanggal->format('d M Y') : '-',
                    'description' => $desc,
                    'amount' => 'Rp ' . number_format($p->jumlah, 0, ',', '.'),
                    'status' => 'Paid',
                    'metode_bayar' => $p->metode_bayar ? ucfirst($p->metode_bayar) : '-',
                    'file_url' => route('mobile.kwitansi.cetak', ['id' => $p->id])
                ];
            });

        // Map active packages for UI
        $formattedActivePackages = $activePackages->map(function($p) {
            $total = $p->tarif->jumlah_pertemuan ?? 0;
            $used = $p->sudah_terpakai ?? 0;
            $remaining = $p->sisa_pertemuan;
            
            $remainingLabel = '';
            if (is_array($remaining)) {
                $remainingLabel = 'P: ' . ($remaining['perilaku'] ?? 0) . ' | F: ' . ($remaining['fisioterapi'] ?? 0);
            } else {
                $remainingLabel = $remaining . ' Sesi';
            }

            return [
                'id' => $p->id,
                'name' => $p->tarif->nama ?? 'Paket Terapi',
                'price' => 'Rp ' . number_format($p->jumlah, 0, ',', '.'),
                'total' => $total,
                'used' => $used,
                'remaining' => $remainingLabel,
                'percentage' => $total > 0 ? round(($used / $total) * 100) : 0,
                'date' => $p->tanggal ? $p->tanggal->format('d M Y') : '-'
            ];
        })->values();

        // Fetch active packages
        $tarif = Tarif::where('is_active', true)->get();
        $therapyPackages = $tarif->map(function($t) {
            $type = $t->jenis_terapi ?? 'all';
            $icon = 'fa-boxes-stacked';
            $color = 'indigo';
            $breakdown = null;
            
            if ($type === 'terapi_perilaku') {
                $icon = 'fa-brain';
                $color = 'orange';
            } elseif ($type === 'fisioterapi') {
                $icon = 'fa-walking';
                $color = 'blue';
            } elseif ($type === 'terapi_wicara') {
                $icon = 'fa-comment-dots';
                $color = 'purple';
            } elseif ($type === 'gabungan') {
                $icon = 'fa-layer-group';
                $color = 'teal';
                $breakdown = [
                    'perilaku' => $t->pertemuan_perilaku ?? 0,
                    'fisioterapi' => $t->pertemuan_fisioterapi ?? 0
                ];
            } elseif ($type === 'assessment') {
                $icon = 'fa-clipboard-check';
                $color = 'rose';
            } elseif ($type === 'observasi') {
                $icon = 'fa-eye';
                $color = 'emerald';
            }

            return [
                'id' => $t->id,
                'name' => $t->nama,
                'type' => $type,
                'icon' => $icon,
                'color' => $color,
                'sessions' => $t->jumlah_pertemuan ?? 0,
                'breakdown' => $breakdown,
                'price' => 'Rp ' . number_format($t->tarif, 0, ',', '.'),
                'description' => $t->deskripsi ?? 'Layanan profesional untuk mendukung tumbuh kembang anak secara optimal.',
                'popular' => $t->nama === 'Paket Premium'
            ];
        });

        // Fetch ALL active therapists from the system
        $therapists = Terapis::where('status', 'aktif')->get()->map(function($t) {
            return [
                'id' => $t->id,
                'name' => $t->nama,
                'specialization' => $t->role ?? ($t->jurusan ?? 'Terapis'),
                'experience' => 'Aktif',
                'status' => 'Aktif',
                'schedule' => 'Senin - Jumat',
                'photo' => $t->foto ? asset('storage/terapis/' . $t->foto) : null,
                'avatar' => strtoupper(substr($t->nama, 0, 2))
            ];
        });

        // Map real attendance data for history (RESTORED for compatibility)
        $attendanceData = $kunjungan->take(15)->map(function($k) {
            return [
                'id' => $k->id,
                'day' => $k->created_at->translatedFormat('l'),
                'date' => $k->created_at->format('d M Y'),
                'type' => 'Terapi ' . ucfirst(str_replace('_', ' ', $k->jenis_terapi)),
                'status' => $k->status === 'hadir' ? 'Hadir' : 
                           ($k->status === 'izin_hangus' ? 'Hangus' : 
                           ($k->status === 'izin' || $k->status === 'sakit' ? 'Izin' : ucfirst($k->status))),
                'mood' => 'happy',
                'therapist' => $k->terapis->nama ?? '-',
                'timeIn' => $k->created_at->format('H:i'),
                'timeOut' => $k->created_at->addHour()->format('H:i')
            ];
        });

        // Fetch Assessments for the child
        $rawAssessments = \App\Models\Assessment::with('Psikolog')
            ->where('anak_id', $anak->id)
            ->orderBy('tanggal_assessment', 'desc')
            ->get();
            
        $assessments = $rawAssessments->map(function($a) {
            return [
                'id' => $a->id,
                'date' => $a->tanggal_assessment ? $a->tanggal_assessment->format('d M Y') : $a->created_at->format('d M Y'),
                'psychologist' => $a->Psikolog->nama ?? 'Psikolog Klinik',
                'diagnosis' => $a->diagnosa ?? 'Evaluasi Perkembangan',
                'iq_score' => $a->skor_iq_total ?? '-',
                'classification' => $a->klasifikasi ?? '-',
                'main_complaint' => $a->keluhan_utama && $a->keluhan_utama != '-' ? $a->keluhan_utama : null,
                'recommendation' => $a->rekomendasi ?? 'Melanjutkan program terapi sesuai jadwal.',
                'examination_results' => $a->hasil_pemeriksaan ?? [],
                'parent_recommendations' => $a->rekomendasi_orangtua ?? [],
                'file_url' => route('mobile.assessment.cetak', ['id' => $a->id]),
            ];
        });

        // Fetch Observations (HasilPemeriksaan) for the child
        $rawObservations = \App\Models\HasilPemeriksaan::where('anak_id', $anak->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });
            
        $observations = $rawObservations->map(function($items, $date) use ($anak) {
            $jenisList = $items->pluck('jenis')->unique()->implode(', ');
            $focus = \Illuminate\Support\Str::limit($jenisList, 30);
            
            // Siapkan ringkasan hasil untuk ditampilkan di Modal
            $resultsSummary = [];
            foreach($items as $item) {
                if(!in_array($item->jenis, ['Pemeriksaan Fisik', 'Anthropometri'])) {
                    $resultsSummary[] = [
                        'jenis' => $item->jenis,
                        'hasil' => $item->hasil
                    ];
                }
            }
            
            return [
                'id' => $date, // uniquely identified by date
                'date' => \Carbon\Carbon::parse($date)->format('d M Y'),
                'time' => $items->first()->created_at->format('H:i'),
                'observer' => 'Tim Klinis', 
                'activity' => 'Evaluasi Tumbuh Kembang',
                'focus' => $focus,
                'result' => 'Selesai',
                'note' => "Telah dilakukan pemeriksaan meliputi: " . $jenisList,
                'results_summary' => $resultsSummary,
                'file_url' => route('mobile.observasi.cetak', ['tanggal' => $date])
            ];
        })->values();

        return view('mobile-new.index', compact(
            'anak', 
            'sessions', 
            'activities', 
            'attendanceData', 
            'therapyPackages', 
            'therapists',
            'activePackages',
            'formattedActivePackages',
            'sesiMingguIni',
            'progress',
            'tagihanCount',
            'invoices',
            'attendanceStats',
            'assessments',
            'observations',
            'profile'
        ))->with('totalPertemuan', $totalPertemuanSum);
    }

    public function cetakAssessment($id)
    {
        $assessment = Assessment::with(['anak', 'Psikolog'])->findOrFail($id);

        // Pastikan hanya anak yang bersangkutan yang bisa akses
        $user = auth()->user();
        $anak = $user->getAnakData();
        if (!$anak || $assessment->anak_id !== $anak->id) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Generate Short Signature for QR security
        $sig = substr(md5($assessment->id . config('app.key')), 0, 8);
        $scanUrl = url("/v/a/{$assessment->id}/{$sig}");

        $dns2d = new DNS2D();
        $barcode = $dns2d->getBarcodePNG($scanUrl, 'QRCODE', 4, 4);

        $profile = \App\Models\Profile::first();

        $logoPath = public_path('assets/website/images/logo.jpg');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/jpeg;base64,' . $logoData;
        }

        $logoPjiPath = public_path('assets/website/images/pji-removebg-preview.png');
        $logoPjiBase64 = '';
        if (file_exists($logoPjiPath)) {
            $pjiData = base64_encode(file_get_contents($logoPjiPath));
            $logoPjiBase64 = 'data:image/png;base64,' . $pjiData;
        }

        $pdfData = [
            'assessment'           => $assessment,
            'observasi_awal'       => $assessment->observasi_awal,
            'sumber_asesmen'       => $assessment->sumber_asesmen,
            'hasil_pemeriksaan'    => $assessment->hasil_pemeriksaan,
            'rekomendasi_orangtua' => $assessment->rekomendasi_orangtua,
            'rekomendasi_terapi'   => $assessment->rekomendasi_terapi,
            'barcode'              => $barcode,
            'logo'                 => $logoBase64,
            'logo_pji'             => $logoPjiBase64,
            'tanggal'              => $assessment->tanggal_assessment
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('assessment.pdf', $pdfData);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'sans-serif'
        ]);

        $filename = 'Hasil-Assessment-' . Str::slug($assessment->anak->nama) . '.pdf';
        
        if (request()->has('download')) {
            return $pdf->download($filename);
        }
        
        return $pdf->stream($filename);
    }

    public function cetakObservasi($tanggal)
    {
        $user = auth()->user();
        $anak = $user->getAnakData();
        if (!$anak) {
            abort(403, 'Akses tidak diizinkan.');
        }

        // Ambil data hasil pemeriksaan
        $hasil = \App\Models\HasilPemeriksaan::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->orderBy('created_at')
            ->get()
            ->groupBy('jenis');

        if ($hasil->isEmpty()) {
            abort(404, 'Data observasi tidak ditemukan.');
        }

        $atec = \App\Models\HasilPemeriksaan::where('anak_id', $anak->id)
            ->whereIn('jenis', ['ATEC', 'ATEC Kuesioner'])
            ->whereDate('created_at', $tanggal)
            ->first();

        $wawancara = \App\Models\QuestionResponseWawancara::with('question_wawancara')
            ->where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal) // using created_at for responses as they don't have tanggal_pemeriksaan
            ->whereNotNull('answer')
            ->where('answer', '!=', '')
            ->get();
            
        $jumlahPertanyaanPendengaran = \App\Models\QuestionResponse::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->count();

        $jumlahJawabanTidakPendengaran = \App\Models\QuestionResponse::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'tidak')
            ->count();

        $jawabanPenglihatan = \App\Models\HasilPemeriksaan::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('jenis', 'Penyimpangan Penglihatan')
            ->first();

        $hpperilaku = \App\Models\HpPerilaku::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->first();
        $hpsensorik = \App\Models\HpSensorik::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->first();
        
        // Hitung jawaban untuk masing-masing tes
        $jumlahJawabanYaPerilaku = \App\Models\QuestionResponsePerilaku::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'YA')
            ->count();

        $criticalNoUrut = [2, 7, 9, 13, 14, 15];

        $jumlahJawabanTidakAutis = \App\Models\QuestionResponseAutis::with(['question_autis'])
            ->where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->where('answer', 'TIDAK')
            ->whereHas('question_autis', function ($query) use ($criticalNoUrut) {
                $query->whereIn('no_urut', $criticalNoUrut);
            })
            ->count();

        $totalNilaiGpph = \App\Models\QuestionResponseGpph::where('anak_id', $anak->id)
            ->whereDate('created_at', $tanggal)
            ->sum('answer');

        // Data yang akan diencode dalam barcode
        $results_summary = [];
        foreach ($hasil as $jenis => $item) {
            $results_summary[] = [
                'jenis' => $jenis,
                'hasil' => $item->first()->hasil
            ];
        }

        // Generate Short Signature for security (to prevent ID enumeration)
        $sig = substr(md5($anak->id . $tanggal . config('app.key')), 0, 8);
        $scanUrl = url("/v/o/{$anak->id}/{$tanggal}/{$sig}");

        $dns2d = new \Milon\Barcode\DNS2D();
        $barcode = $dns2d->getBarcodePNG($scanUrl, 'QRCODE', 4, 4);

        $anthropometris = \App\Models\Anthropometri::where('anak_id', $anak->id)->whereDate('created_at', $tanggal)->get();
        $kpsp = \App\Models\HasilPemeriksaan::where('anak_id', $anak->id)->where('jenis', 'KPSP')->whereDate('created_at', $tanggal)->first();

        // Encode logo ke Base64 agar pasti terbaca oleh DomPDF
        $logoPath = public_path('assets/website/images/logo.jpg');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/jpeg;base64,' . $logoData;
        }

        $logoPjiPath = public_path('assets/website/images/pji-removebg-preview.png');
        $logoPjiBase64 = '';
        if (file_exists($logoPjiPath)) {
            $pjiData = base64_encode(file_get_contents($logoPjiPath));
            $logoPjiBase64 = 'data:image/png;base64,' . $pjiData;
        }

        // Siapkan data untuk view
        $data = [
            'anak' => $anak,
            'barcode' => $barcode,
            'logo' => $logoBase64,
            'logo_pji' => $logoPjiBase64,
            'atec' => $atec,
            'hasil' => $hasil,
            'tanggal' => $tanggal,
            'penyimpangan_perilaku' => "Kuesioner Masalah Mental Emosional (KMME)",
            'penyimpangan_pendengaran' => "Tes Daya Dengar (TDD)",
            'penyimpangan_penglihatan' => "Tes Daya Lihat (TDL)",
            'autis' => "Checklist for Autism in Toddlers (CHAT)",
            'gpph' => "Gangguan Pemusatan Perhatian dan Hiperaktif (GPPH)",
            'jumlahJawabanYaPerilaku' => $jumlahJawabanYaPerilaku,
            'jumlahJawabanTidakAutis' => $jumlahJawabanTidakAutis,
            'jumlahPertanyaanPendengaran' => $jumlahPertanyaanPendengaran,
            'jumlahJawabanTidakPendengaran' => $jumlahJawabanTidakPendengaran,
            'jawabanPenglihatan' => $jawabanPenglihatan,
            'totalNilaiGpph' => $totalNilaiGpph,
            'hpperilaku' => $hpperilaku,
            'hpsensorik' => $hpsensorik,
            'wawancara' => $wawancara,
            'anthropometris' => $anthropometris,
            'kpsp' => $kpsp
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('observasi.pdf_hasil', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'sans-serif'
        ]);

        $filename = 'Laporan-Observasi-' . \Illuminate\Support\Str::slug($anak->nama) . '-' . $tanggal . '.pdf';
        
        if (request()->has('download')) {
            return $pdf->download($filename);
        }
        
        return $pdf->stream($filename);
    }

    public function cetakKwitansi($id)
    {
        $pemasukkan = \App\Models\Pemasukkan::with(['Tarif', 'anak', 'kategori'])->findOrFail($id);

        // Pastikan hanya anak yang bersangkutan yang bisa akses (Mendukung nama anak yang sama)
        $user = auth()->user();
        $anak = $user->getAnakData();
        if (!$anak) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $anakIds = \App\Models\Anak::where('nama', $anak->nama)->pluck('id')->toArray();
        $isAuthorized = false;
        
        if (in_array($pemasukkan->anak_id, $anakIds)) {
            $isAuthorized = true;
        } elseif (!$pemasukkan->anak_id && $pemasukkan->deskripsi && stripos($pemasukkan->deskripsi, $anak->nama) !== false) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $pdfData = [
            'pemasukkan' => $pemasukkan,
        ];

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('keuangan.kwitansi_pdf', $pdfData);
        
        // Ukuran Thermal 80mm dalam points (1mm = 2.83465pt)
        // 80mm = 226.77pt, 150mm = 425.2pt
        $pdf->setPaper([0, 0, 226.77, 425.2], 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => true,
            'defaultFont'          => 'monospace'
        ]);

        $filename = 'Kwitansi-' . $pemasukkan->id . '.pdf';
        
        if (request()->has('download')) {
            return $pdf->download($filename);
        }
        
        return $pdf->stream($filename);
    }
}
