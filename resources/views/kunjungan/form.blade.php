@csrf
<div class="space-y-6" x-data="{
    generatedText: '',
    generatedOrangTua: '',
    choices: {
        kondisiAnak: '',
        responInstruksi: '',
        responNama: '',
        fokus: '',
        imitasi: '',
        komunikasi: '',
        perilakuTambahan: '',
        motorikHalus: '',
        transisiAkhir: '',
        regulasiDiri: '',
        kontakMata: '',
        hasilKegiatan: 'baik'
    },
    data: {
        kondisiAnak: {
            kooperatif: {
                evaluasi: 'Pertahankan sikap kooperatif anak untuk meningkatkan efektivitas terapi.',
                orangTua: 'Hebat! Anak sangat kooperatif hari ini. Teruskan kebiasaan baik ini di rumah ya.'
            },
            antusias: {
                evaluasi: 'Tingkatkan kompleksitas tugas karena anak menunjukkan antusiasme yang tinggi.',
                orangTua: 'Anak sangat bersemangat hari ini! Di rumah, dukung terus kegiatannya dengan pujian.'
            },
            lesu: {
                evaluasi: 'Beri jeda istirahat atau aktivitas penyegaran karena anak tampak lesu.',
                orangTua: 'Anak tampak kurang bersemangat hari ini. Pastikan istirahatnya cukup sebelum terapi ya.'
            },
            rewel: {
                evaluasi: 'Lakukan regulasi emosi di awal sesi karena anak menunjukkan perilaku rewel.',
                orangTua: 'Anak sempat rewel hari ini. Jika di rumah rewel, coba tenangkan dulu sebelum diajak belajar.'
            },
            cemas: {
                evaluasi: 'Beri waktu adaptasi lebih lama dan kurangi tekanan tugas karena anak tampak cemas.',
                orangTua: 'Anak butuh waktu untuk beradaptasi. Di rumah, ciptakan suasana yang nyaman saat dia belajar.'
            },
            aktifBergerak: {
                evaluasi: 'Arahkan energi aktifnya ke aktivitas terstruktur yang membutuhkan konsentrasi.',
                orangTua: 'Anak sangat aktif bergerak. Di rumah, ajak dia bermain aktif yang aman untuk menyalurkan energinya.'
            }
        },
        responInstruksi: {
            sekaliLangsung: {
                evaluasi: 'Dapat mulai diberikan instruksi 2-3 tahapan karena anak mampu mengikuti dalam satu kali pemberian.',
                orangTua: 'Hebat! Anak bisa langsung paham instruksi. Coba berikan tugas mandiri di rumah.'
            },
            perluPengulangan: {
                evaluasi: 'Gunakan kalimat yang lebih pendek dan sederhana serta berikan pengulangan.',
                orangTua: 'Ulangi instruksi dengan sabar jika anak belum merespons di rumah ya.'
            },
            perluPrompt: {
                evaluasi: 'Lanjutkan pemberian prompt (bantuan) dan kurangi secara bertahap.',
                orangTua: 'Bantu anak (arahkan fisik/verbal) saat dia kesulitan mengikuti perintah di rumah.'
            },
            tidakMerespons: {
                evaluasi: 'Gunakan stimulus yang lebih kuat atau isyarat visual untuk menarik respons anak.',
                orangTua: 'Panggil nama anak atau tepuk lembut pundaknya untuk menarik perhatiannya di rumah.'
            },
            terburuBuru: {
                evaluasi: 'Latih anak untuk mendengarkan instruksi sampai selesai sebelum bertindak.',
                orangTua: 'Ingatkan anak untuk sabar mendengarkan sampai Ayah/Bunda selesai bicara baru bertindak.'
            }
        },
        responNama: {
            baikDekatJauh: {
                evaluasi: 'Pertahankan respons panggilan nama yang sudah baik dari berbagai jarak.',
                orangTua: 'Latih terus di rumah dengan memanggil anak dari ruangan yang berbeda.'
            },
            hanyaDekat: {
                evaluasi: 'Tingkatkan jarak pemanggilan secara bertahap untuk melatih respons jarak jauh.',
                orangTua: 'Coba panggil anak dari jarak yang agak jauh saat di rumah ya.'
            },
            tidakKonsisten: {
                evaluasi: 'Pastikan ada kontak mata saat memanggil nama untuk meningkatkan konsistensi.',
                orangTua: 'Pastikan anak melihat Ayah/Bunda saat namanya dipanggil di rumah.'
            },
            tidakMerespons: {
                evaluasi: 'Gunakan intonasi yang bervariasi atau dekati anak saat memanggil namanya.',
                orangTua: 'Dekati anak dan sejajarkan mata saat memanggil namanya jika dia tidak merespons.'
            }
        },
        fokus: {
            penuhSesiBerjalan: {
                evaluasi: 'Pertahankan durasi fokus dan tingkatkan tingkat kesulitan tugas.',
                orangTua: 'Fokus anak sangat bagus! Berikan kegiatan yang dia sukai untuk melatih ketahanannya.'
            },
            baikDenganJeda: {
                evaluasi: 'Berikan jeda singkat (brain break) di antara tugas untuk menjaga kualitas fokus.',
                orangTua: 'Beri anak istirahat sejenak di sela-sela waktu belajarnya di rumah.'
            },
            mudahTeralihkan: {
                evaluasi: 'Minimalkan distraksi di lingkungan sekitar saat anak mengerjakan tugas.',
                orangTua: 'Matikan TV atau jauhkan mainan lain saat anak sedang belajar di rumah.'
            },
            sulitFokus: {
                evaluasi: 'Berikan tugas dengan durasi sangat pendek namun sering.',
                orangTua: 'Berikan kegiatan singkat saja dulu di rumah agar anak tidak cepat jenuh.'
            },
            intervalMembaik: {
                evaluasi: 'Lanjutkan latihan ketahanan fokus untuk mempertahankan peningkatan yang ada.',
                orangTua: 'Fokus anak mulai membaik. Teruskan latihan fokusnya di rumah secara konsisten.'
            }
        },
        imitasi: {
            spontan: {
                evaluasi: 'Tingkatkan ke imitasi gerakan yang lebih kompleks atau berurutan.',
                orangTua: 'Ajak anak bermain meniru gerakan senam atau tarian sederhana di rumah.'
            },
            denganPrompt: {
                evaluasi: 'Kurangi bantuan fisik (prompt) secara perlahan agar anak lebih mandiri dalam meniru.',
                orangTua: 'Bantu gerakkan tangan/tubuh anak saat mengajarkan gerakan baru di rumah.'
            },
            parsialBingung: {
                evaluasi: 'Pecah gerakan menjadi tahapan yang lebih sederhana saat mengajarkan imitasi.',
                orangTua: 'Contohkan gerakan secara perlahan-lahan agar anak tidak bingung menirunya.'
            },
            belumMampu: {
                evaluasi: 'Fokus pada imitasi gerakan kasar yang sederhana dan bermakna.',
                orangTua: 'Mulai dengan meniru gerakan sederhana seperti tepuk tangan atau melambai.'
            }
        },
        komunikasi: {
            inisiatifSendiri: {
                evaluasi: 'Dukung inisiatif komunikasinya dengan memberikan respons positif dan perluasan kalimat.',
                orangTua: 'Dengarkan dan tanggapi setiap kali anak mencoba memulai obrolan di rumah.'
            },
            responSaja: {
                evaluasi: 'Pancing anak untuk memulai komunikasi, bukan hanya sekadar merespons.',
                orangTua: 'Beri anak pilihan (mau ini atau itu?) untuk memancingnya berbicara.'
            },
            denganGestur: {
                evaluasi: 'Labeli gesturnya dengan kata-kata untuk mendorong komunikasi verbal.',
                orangTua: 'Jika anak menunjuk sesuatu, sebutkan nama bendanya agar dia belajar kosakatanya.'
            },
            belumVerbal: {
                evaluasi: 'Fokus pada komunikasi non-verbal yang fungsional (menunjuk, kontak mata).',
                orangTua: 'Latih anak menggunakan bahasa isyarat sederhana atau menunjuk untuk meminta sesuatu.'
            },
            ekspresifBaik: {
                evaluasi: 'Latih anak untuk menyusun kalimat yang lebih panjang dan lengkap.',
                orangTua: 'Ajak anak bercerita tentang kegiatannya hari ini dengan kalimat sederhana.'
            },
            duaArahMembaik: {
                evaluasi: 'Pertahankan dan tingkatkan kualitas komunikasi dua arah (tanya-jawab).',
                orangTua: 'Sering-sering ajak anak mengobrol santai dan tanya-jawab di rumah.'
            }
        },
        perilakuTambahan: {
            tantrumTerkontrol: {
                evaluasi: 'Gunakan teknik pengabaian terencana (planned ignoring) atau pengalihan saat tantrum ringan.',
                orangTua: 'Tetap tenang saat anak tantrum di rumah, dan alihkan perhatiannya ke hal lain.'
            },
            tantrumTidakTerkontrol: {
                evaluasi: 'Utamakan keselamatan anak dan bantu regulasi emosinya sebelum melanjutkan tugas.',
                orangTua: 'Pastikan anak berada di tempat yang aman saat tantrum hebat, dekap erat jika diperlukan.'
            },
            mandiri: {
                evaluasi: 'Berikan tugas yang membutuhkan kemandirian lebih tinggi.',
                orangTua: 'Beri anak tanggung jawab kecil di rumah, seperti merapikan mainannya sendiri.'
            },
            butuhanFisik: {
                evaluasi: 'Berikan bantuan fisik seperlunya dan dorong anak untuk mencoba sendiri.',
                orangTua: 'Jangan terlalu cepat membantu anak di rumah, biarkan dia mencoba usahanya dulu.'
            }
        },
        motorikHalus: {
            genggamPensil: {
                evaluasi: 'Gunakan adaptasi alat tulis (seperti pencil grip) untuk memperbaiki cara pegang.',
                orangTua: 'Bantu anak membetulkan posisi jarinya saat memegang pensil atau sendok.'
            },
            pegangPulpenBaik: {
                evaluasi: 'Lanjutkan latihan menulis atau menggambar untuk memperkuat kontrol jari.',
                orangTua: 'Ajak anak menggambar atau mewarnai bersama di rumah.'
            },
            latihOtotJari: {
                evaluasi: 'Berikan aktivitas meremas, menjumput, atau memelintir untuk memperkuat otot jari.',
                orangTua: 'Ajak anak bermain playdough (malam), meremas kertas, atau memindahkan biji-bijian.'
            },
            mengguntingMenulis: {
                evaluasi: 'Tingkatkan tingkat kesulitan aktivitas motorik halus secara bertahap.',
                orangTua: 'Latih anak menggunting kertas mengikuti garis lurus atau zig-zag di rumah.'
            },
            mewarnaiRapi: {
                evaluasi: 'Berikan apresiasi dan tingkatkan ke tugas yang membutuhkan ketelitian lebih tinggi.',
                orangTua: 'Puji hasil mewarnai anak yang rapi dan pajang karyanya di rumah.'
            }
        },
        transisiAkhir: {
            menolakKeluarMenulis: {
                evaluasi: 'Gunakan jadwal visual atau timer untuk mempersiapkan anak menghadapi transisi akhir sesi.',
                orangTua: 'Beri tahu anak beberapa menit sebelum waktu bermainnya di rumah selesai.'
            },
            marahAkhirSesi: {
                evaluasi: 'Beri jeda pendinginan (cool down) dan jelaskan aktivitas berikutnya setelah terapi.',
                orangTua: 'Beri anak pengertian dengan lembut saat harus menyudahi aktivitas yang dia sukai.'
            }
        },
        regulasiDiri: {
            seringBerbaring: {
                evaluasi: 'Latih ketahanan postur duduk dan batasi waktu berbaring saat tugas.',
                orangTua: 'Ingatkan anak untuk duduk tegak saat makan atau belajar di rumah.'
            },
            mudahFrustasi: {
                evaluasi: 'Beri tugas yang pasti bisa dia selesaikan dulu untuk membangun rasa percaya diri.',
                orangTua: 'Bantu anak sebelum dia merasa terlalu frustasi dengan tugas sulit di rumah.'
            },
            menyerahBerteriak: {
                evaluasi: 'Ajarkan cara meminta bantuan secara fungsional (misal: bilang bantu).',
                orangTua: 'Ajarkan anak untuk bilang tolong bantu daripada berteriak saat kesulitan.'
            },
            merengekKesulitan: {
                evaluasi: 'Abaikan rengekan dan dorong anak untuk menggunakan kata-kata saat meminta bantuan.',
                orangTua: 'Minta anak bicara dengan tenang (tidak merengek) saat meminta sesuatu di rumah.'
            }
        },
        kontakMata: {
            cukupBaik: {
                evaluasi: 'Pertahankan dan tingkatkan durasi kontak mata selama interaksi berlangsung.',
                orangTua: 'Puji anak setiap kali dia menatap mata Ayah/Bunda saat berbicara.'
            },
            semakinBaik: {
                evaluasi: 'Lanjutkan stimulasi visual untuk mempertahankan tren positif kontak mata.',
                orangTua: 'Kontak matanya semakin bagus! Teruskan kebiasaan mengobrol sambil bertatapan.'
            },
            sulit: {
                evaluasi: 'Gunakan benda menarik di dekat mata terapis untuk memancing kontak mata.',
                orangTua: 'Dekatkan benda yang dia sukai ke dekat wajah Ayah/Bunda untuk menarik pandangannya.'
            }
        }
    },
    updateText() {
        let evalLines = [];
        let otLines = [];
        for (let category in this.choices) {
            if (category === 'hasilKegiatan') continue;
            let key = this.choices[category];
            if (key && this.data[category][key]) {
                let evalText = this.data[category][key].evaluasi;
                let otText = this.data[category][key].orangTua;
                
                if (!evalLines.includes(evalText)) {
                    evalLines.push(evalText);
                }
                if (!otLines.includes(otText)) {
                    otLines.push(otText);
                }
            }
        }
        this.generatedText = evalLines.map(line => '• ' + line).join('\n');
        this.generatedOrangTua = otLines.map(line => '• ' + line).join('\n');
    },
    handleEnter(e, field) {
        const textarea = e.target;
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = this[field];
        
        this[field] = text.substring(0, start) + '\n• ' + text.substring(end);
        
        this.$nextTick(() => {
            textarea.selectionStart = textarea.selectionEnd = start + 3;
        });
    }
}">
    {{-- Terapis Info (read-only) --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis Pelaksana</label>
        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <i data-lucide="user-check" class="w-4 h-4 text-emerald-500"></i>
            <span class="text-sm font-black text-slate-700 uppercase">{{ $kunjungan->terapis->nama }}</span>
        </div>
        <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id }}">
        {{-- Hidden input for JSON choices --}}
        <input type="hidden" name="pilihan_respons" :value="JSON.stringify(choices)">
    </div>

    {{-- Program Items --}}
    <div id="form-wrapper" class="space-y-4">
        <div class="container-form space-y-4">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Program Terapi <span class="text-red-500">*</span></label>
                    <select class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none select2" name="program_id[0]">
                        @foreach ($program as $p)
                            <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="add-button" class="shrink-0 mt-5 flex items-center gap-2 px-4 py-3 bg-slate-900 hover:bg-black text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah
                </button>
            </div>

            {{-- Skala Radio --}}
            <div class="flex flex-wrap gap-3">
                <label for="status_dp_0" class="flex-1 cursor-pointer group">
                    <input type="radio" id="status_dp_0" name="status[0]" value="dp" required class="sr-only peer">
                    <div class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl peer-checked:border-red-500 peer-checked:bg-red-500 peer-checked:text-white transition-all shadow-sm group-hover:bg-slate-100">
                        <span class="text-xs font-black uppercase tracking-widest">DP</span>
                    </div>
                </label>
                <label for="status_ds_0" class="flex-1 cursor-pointer group">
                    <input type="radio" id="status_ds_0" name="status[0]" value="ds" class="sr-only peer">
                    <div class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl peer-checked:border-amber-500 peer-checked:bg-amber-500 peer-checked:text-white transition-all shadow-sm group-hover:bg-slate-100">
                        <span class="text-xs font-black uppercase tracking-widest">DS</span>
                    </div>
                </label>
                <label for="status_tb_0" class="flex-1 cursor-pointer group">
                    <input type="radio" id="status_tb_0" name="status[0]" value="tb" class="sr-only peer">
                    <div class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl peer-checked:border-emerald-500 peer-checked:bg-emerald-500 peer-checked:text-white transition-all shadow-sm group-hover:bg-slate-100">
                        <span class="text-xs font-black uppercase tracking-widest">TB</span>
                    </div>
                </label>
            </div>
        </div>
    </div>

    {{-- Dropdowns Pilihan Otomatis --}}
    <div class="space-y-3 p-5 bg-slate-50 rounded-2xl border border-slate-100">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Pilihan Respons Cepat</label>
        <div class="grid grid-cols-2 gap-4">
            <!-- Kondisi Anak -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Kondisi Anak</label>
                <select x-model="choices.kondisiAnak" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="kooperatif">Kooperatif</option>
                    <option value="antusias">Antusias</option>
                    <option value="lesu">Lesu</option>
                    <option value="rewel">Rewel</option>
                    <option value="cemas">Cemas</option>
                    <option value="aktifBergerak">Aktif Bergerak</option>
                </select>
            </div>
            <!-- Respons Instruksi -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Respons Instruksi</label>
                <select x-model="choices.responInstruksi" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="sekaliLangsung">Sekali Langsung</option>
                    <option value="perluPengulangan">Perlu Pengulangan</option>
                    <option value="perluPrompt">Perlu Prompt</option>
                    <option value="tidakMerespons">Tidak Merespons</option>
                </select>
            </div>
            <!-- Respons Panggilan Nama -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Respons Panggilan Nama</label>
                <select x-model="choices.responNama" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="baikDekatJauh">Baik Dekat & Jauh</option>
                    <option value="hanyaDekat">Hanya Dekat</option>
                    <option value="tidakKonsisten">Tidak Konsisten</option>
                    <option value="tidakMerespons">Tidak Merespons</option>
                </select>
            </div>
            <!-- Fokus & Perhatian -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Fokus & Perhatian</label>
                <select x-model="choices.fokus" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="penuhSesiBerjalan">Penuh Sesi Berjalan</option>
                    <option value="baikDenganJeda">Baik Dengan Jeda</option>
                    <option value="mudahTeralihkan">Mudah Teralihkan</option>
                    <option value="sulitFokus">Sulit Fokus</option>
                    <option value="intervalMembaik">Interval Fokus Membaik</option>
                </select>
            </div>
            <!-- Imitasi -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Imitasi</label>
                <select x-model="choices.imitasi" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="spontan">Spontan</option>
                    <option value="denganPrompt">Dengan Prompt</option>
                    <option value="parsialBingung">Parsial Bingung</option>
                    <option value="belumMampu">Belum Mampu</option>
                </select>
            </div>
            <!-- Komunikasi -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Komunikasi</label>
                <select x-model="choices.komunikasi" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="inisiatifSendiri">Inisiatif Sendiri</option>
                    <option value="responSaja">Respon Saja</option>
                    <option value="denganGestur">Dengan Gestur</option>
                    <option value="belumVerbal">Belum Verbal</option>
                    <option value="ekspresifBaik">Ekspresif Membaik</option>
                    <option value="duaArahMembaik">Dua Arah Membaik</option>
                </select>
            </div>
            <!-- Perilaku Tambahan -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Perilaku Tambahan</label>
                <select x-model="choices.perilakuTambahan" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="tantrumTerkontrol">Tantrum Terkontrol</option>
                    <option value="tantrumTidakTerkontrol">Tantrum Tidak Terkontrol</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="butuhanFisik">Butuh Bantuan Fisik</option>
                </select>
            </div>
            <!-- Motorik Halus -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Motorik Halus</label>
                <select x-model="choices.motorikHalus" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="genggamPensil">Masih Menggenggam Alat</option>
                    <option value="pegangPulpenBaik">Pegang Alat Membaik</option>
                    <option value="latihOtotJari">Butuh Latihan Otot Jari</option>
                    <option value="mengguntingMenulis">Kemampuan Membaik</option>
                    <option value="mewarnaiRapi">Hasil Kerja Rapi</option>
                </select>
            </div>
            <!-- Transisi & Akhir Sesi -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Transisi / Akhir Sesi</label>
                <select x-model="choices.transisiAkhir" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="menolakKeluarMenulis">Menolak Keluar (Lanjut Kegiatan)</option>
                    <option value="marahAkhirSesi">Marah di Akhir Sesi</option>
                </select>
            </div>
            <!-- Regulasi Diri -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Regulasi Diri / Postur</label>
                <select x-model="choices.regulasiDiri" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="seringBerbaring">Sering Berbaring</option>
                    <option value="mudahFrustasi">Mudah Frustasi</option>
                    <option value="menyerahBerteriak">Menyerah & Berteriak</option>
                    <option value="merengekKesulitan">Merengek Saat Kesulitan</option>
                </select>
            </div>
            <!-- Kontak Mata -->
            <div class="space-y-1 col-span-2">
                <label class="text-[9px] font-black text-slate-500 uppercase">Kontak Mata</label>
                <select x-model="choices.kontakMata" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="cukupBaik">Cukup Baik</option>
                    <option value="semakinBaik">Semakin Membaik</option>
                    <option value="sulit">Sulit Kontak Mata</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Hasil Seluruh Kegiatan -->
    <div class="space-y-1">
        <label class="text-[9px] font-black text-slate-500 uppercase">Hasil Seluruh Kegiatan Terapi</label>
        <select name="hasil_kegiatan" x-model="choices.hasilKegiatan" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-red-50 transition-all outline-none">
            <option value="baik">Menyelesaikan sesi dengan baik</option>
            <option value="cukup">Menyelesaikan sesi dengan cukup baik</option>
            <option value="kurang">Belum mampu menyelesaikan sesi dengan baik</option>
        </select>
    </div>

    {{-- Keterangan --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Evaluasi Sesi <span class="text-red-500">*</span></label>
        <textarea name="keterangan" rows="6" required
                  x-model="generatedText"
                  @keydown.enter.prevent="handleEnter($event, 'generatedText')"
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Tuliskan catatan perkembangan pasien..."></textarea>
        @error('keterangan')
            <p class="text-[10px] font-black text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Catatan Orang Tua --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan untuk Orang Tua di Rumah</label>
        <textarea name="catatan_orang_tua" rows="4"
                  x-model="generatedOrangTua"
                  @keydown.enter.prevent="handleEnter($event, 'generatedOrangTua')"
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Saran latihan di rumah untuk orang tua..."></textarea>
        @error('catatan_orang_tua')
            <p class="text-[10px] font-black text-red-500">{{ $message }}</p>
        @enderror
    </div>

    {{-- Actions --}}
    <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
        <a href="{{ url()->previous() }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
        <button type="submit" class="px-12 py-3 bg-slate-900 hover:bg-black text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl transition-all">{{ $tombol }}</button>
    </div>
</div>
