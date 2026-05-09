<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anak;
use App\Models\Terapis;
use App\Models\Informasi;
use App\Models\Kunjungan;
use App\Models\Tarif;

class MobileNewController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $anak = $user->getAnakData();
        
        if (!$anak) {
            return redirect()->route('login')->with('error', 'Data anak tidak ditemukan.');
        }

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
        $latestPemasukkan = $activePackages->first();

        $attendanceKunjungan = $kunjungan;
        $totalPertemuan = 20; // Default fallback

        if ($latestPemasukkan) {
            $attendanceKunjungan = $kunjungan->where('pemasukkan_id', $latestPemasukkan->id);
            $totalPertemuan = $latestPemasukkan->tarif->jumlah_pertemuan ?? 20;
        } else {
            // Fallback if no active package found
            $latestPemasukkan = $pemasukkans->first();
            if ($latestPemasukkan) {
                $attendanceKunjungan = $kunjungan->where('pemasukkan_id', $latestPemasukkan->id);
                $totalPertemuan = $latestPemasukkan->tarif->jumlah_pertemuan ?? 20;
            }
        }

        // Map data for sessions (Buku Penghubung)
        $sessions = $kunjungan->map(function($k) {
            return [
                'id' => $k->id,
                'type' => $k->jenis_terapi === 'terapi_perilaku' ? 'sensori' : 'wicara', // Mapping to match view icons
                'date' => $k->created_at->format('d M Y'),
                'time' => $k->created_at->format('H:i'),
                'therapist' => $k->terapis->nama ?? 'Terapis',
                'status' => $k->status_sesi === 'selesai' ? 'excellent' : 'good',
                'note' => $k->catatan ?? 'Tidak ada catatan untuk sesi ini.',
                'mission' => 'Lanjutkan latihan di rumah untuk hasil maksimal.'
            ];
        });

        // Map data for activities (Recent Activities) - Hanya yang hadir
        $activities = $kunjungan->where('status', 'hadir')->take(5)->map(function($k) {
            $note = null;
            if ($k->jenis_terapi === 'terapi_perilaku') {
                $pem = $k->pemeriksaans->first();
                if ($pem && $pem->hasil_kegiatan) {
                    $note = $pem->hasil_kegiatan === 'baik' ? 'Menyelesaikan sesi dengan baik.' : 
                           ($pem->hasil_kegiatan === 'cukup' ? 'Menyelesaikan sesi dengan cukup baik.' : 'Menyelesaikan sesi dengan kurang baik.');
                }
            } else {
                $fisio = $k->fisioterapis->first();
                if ($fisio && $fisio->hasil_kegiatan) {
                    $note = $fisio->hasil_kegiatan === 'baik' ? 'Menyelesaikan sesi dengan baik.' : 
                           ($fisio->hasil_kegiatan === 'cukup' ? 'Menyelesaikan sesi dengan cukup baik.' : 'Menyelesaikan sesi dengan kurang baik.');
                }
            }

            return [
                'title' => 'Terapi ' . ucfirst(str_replace('_', ' ', $k->jenis_terapi)),
                'status' => 'Hadir',
                'note' => $note,
                'therapist' => $k->terapis->nama ?? 'Terapis',
                'time' => $k->created_at->diffForHumans(),
                'color' => $k->jenis_terapi === 'terapi_perilaku' ? 'green' : 'blue',
                'liked' => false
            ];
        });

        // Map data for attendance (Using filtered kunjungan!)
        $attendanceData = $attendanceKunjungan->map(function($k) {
            return [
                'id' => $k->id,
                'day' => $k->created_at->translatedFormat('l'),
                'date' => $k->created_at->format('d M Y'),
                'type' => 'Terapi ' . ucfirst(str_replace('_', ' ', $k->jenis_terapi)),
                'status' => 'Hadir', // Assuming present if record exists
                'mood' => 'happy',
                'therapist' => $k->terapis->nama ?? '-',
                'timeIn' => $k->created_at->format('H:i'),
                'timeOut' => $k->created_at->addHour()->format('H:i') // Dummy end time
            ];
        });

        // Fetch active packages
        $tarif = Tarif::where('is_active', true)->get();
        $therapyPackages = $tarif->map(function($t) {
            return [
                'id' => $t->id,
                'name' => $t->nama,
                'sessions' => $t->jumlah_pertemuan ?? 0,
                'price' => 'Rp ' . number_format($t->tarif, 0, ',', '.'),
                'period' => $t->jumlah_pertemuan ? 'Paket' : 'Sesi',
                'features' => [$t->deskripsi ?? 'Sesi terapi berkualitas.'],
                'popular' => $t->nama === 'Paket Premium' // Example
            ];
        });

        // Fetch active therapists
        $therapists = Terapis::where('status', 'aktif')->get()->map(function($t) {
            return [
                'id' => $t->id,
                'name' => $t->nama,
                'specialization' => $t->spesialisasi ?? 'Terapis',
                'experience' => 'N/A',
                'rating' => 4.9,
                'status' => 'Available',
                'schedule' => 'Senin-Jumat',
                'avatar' => strtoupper(substr($t->nama, 0, 2))
            ];
        });

        return view('mobile-new.index', compact(
            'anak', 
            'sessions', 
            'activities', 
            'attendanceData', 
            'therapyPackages', 
            'therapists',
            'activePackages',
            'totalPertemuan'
        ));
    }
}
