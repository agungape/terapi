@csrf
<div class="space-y-6" x-data="{
    choices: {
        aktivitasKelas: '',
        responsTugas: '',
        fokusKontakMata: '',
        responInstruksi: '',
        sensori: '',
        perilakuMood: '',
        latihanFisik: '',
        hasilKegiatan: 'baik'
    },
    data: {
        aktivitasKelas: {
            aktifBerlari: {
                evaluasi: 'Perlu pengawasan dan pembatasan ruang gerak karena anak masih cenderung berlari aktif.',
                orangTua: 'Di rumah, mohon bantu batasi ruang gerak anak saat belajar agar lebih fokus dan tidak lari-larian.'
            },
            aktifBerjalan: {
                evaluasi: 'Dapat mulai diarahkan ke aktivitas terstruktur karena anak sudah lebih tenang saat berjalan.',
                orangTua: 'Di rumah, Ayah/Bunda bisa mulai mengajak anak melakukan kegiatan sederhana yang duduk tenang.'
            },
            dudukTenang: {
                evaluasi: 'Pertahankan durasi duduk tenang dan tingkatkan kompleksitas tugas.',
                orangTua: 'Hebat! Di rumah, terus latih anak untuk duduk tenang saat makan atau bermain ya.'
            },
            masihAktif: {
                evaluasi: 'Perlu aktivitas penyaluran energi (heavy work) di awal sesi karena anak masih sangat aktif.',
                orangTua: 'Sebelum belajar di rumah, ajak anak melakukan aktivitas fisik ringan dulu untuk menyalurkan energinya.'
            },
            berpindahAktivitas: {
                evaluasi: 'Perlu membatasi pilihan mainan/alat agar anak tidak terlalu cepat berpindah aktivitas.',
                orangTua: 'Di rumah, sebaiknya berikan mainan satu per satu agar anak tidak cepat bosan dan berpindah-pindah.'
            },
            eksplorasiAktif: {
                evaluasi: 'Beri batasan area yang jelas untuk mengarahkan eksplorasi anak ke hal yang positif.',
                orangTua: 'Dampingi anak saat mengeksplorasi rumah dan arahkan ke kegiatan yang aman.'
            },
            menolakBerpartisipasi: {
                evaluasi: 'Cari stimulus yang lebih menarik atau turunkan ekspektasi tugas karena anak menolak berpartisipasi.',
                orangTua: 'Jika anak menolak belajar di rumah, coba gunakan mainan kesukaannya sebagai pancingan.'
            }
        },
        responsTugas: {
            denganBantuan: {
                evaluasi: 'Lanjutkan pemberian bantuan (prompt) fisik dan kurangi secara bertahap (fading).',
                orangTua: 'Di rumah, bantu anak menyelesaikan tugasnya tapi kurangi bantuan sedikit demi sedikit ya.'
            },
            denganBaik: {
                evaluasi: 'Tingkatkan tingkat kesulitan tugas karena anak sudah mampu merespons dengan baik.',
                orangTua: 'Anak sudah hebat! Di rumah bisa mulai diberikan tugas yang sedikit lebih menantang.'
            },
            awalSampaiSelesai: {
                evaluasi: 'Pertahankan konsistensi tugas agar anak terbiasa menyelesaikan dari awal sampai selesai.',
                orangTua: 'Pastikan anak menyelesaikan apa yang dia mulai di rumah, jangan dibiarkan berhenti di tengah jalan.'
            },
            mandiriSebagian: {
                evaluasi: 'Beri dorongan lebih pada bagian tugas yang belum mampu diselesaikan secara mandiri.',
                orangTua: 'Puji usaha mandiri anak di rumah, dan bantu hanya pada bagian yang dia benar-benar kesulitan.'
            },
            perluPrompt: {
                evaluasi: 'Perlu konsistensi dalam memberikan prompt fisik atau verbal agar tugas dapat selesai.',
                orangTua: 'Di rumah, berikan instruksi atau bantuan fisik yang konsisten agar anak paham apa yang harus dilakukan.'
            }
        },
        fokusKontakMata: {
            fokusKontakMataMembaik: {
                evaluasi: 'Lanjutkan latihan kontak mata untuk mempertahankan peningkatan durasi fokus.',
                orangTua: 'Sering-sering ajak anak bertatap mata saat berbicara atau bermain di rumah ya.'
            },
            kontakMataMembaik: {
                evaluasi: 'Fokus pada peningkatan durasi kontak mata dalam berbagai aktivitas.',
                orangTua: 'Coba tahan perhatian anak agar menatap mata Ayah/Bunda lebih lama saat mengobrol.'
            },
            mudahTerdistraksi: {
                evaluasi: 'Lakukan terapi di area yang minim distraksi visual dan suara.',
                orangTua: 'Saat anak belajar di rumah, matikan TV atau jauhkan mainan lain agar dia bisa fokus.'
            },
            fokusSingkat: {
                evaluasi: 'Berikan tugas dengan durasi pendek namun sering untuk mengakomodasi rentang fokus yang singkat.',
                orangTua: 'Berikan kegiatan singkat saja di rumah, tapi lakukan berulang kali agar anak tidak jenuh.'
            },
            mudahTeralihkan: {
                evaluasi: 'Gunakan isyarat visual atau verbal yang lebih kuat untuk menarik kembali perhatian anak.',
                orangTua: 'Panggil nama anak atau sentuh lembut pundaknya untuk menarik kembali fokusnya saat bermain.'
            }
        },
        responInstruksi: {
            ikutiInstruksiBaik: {
                evaluasi: 'Dapat mulai diberikan instruksi 2-3 tahapan karena respons sudah baik.',
                orangTua: 'Di rumah, coba berikan 2 instruksi sekaligus (misal: ambil buku lalu taruh di meja).'
            },
            perluPengulangan: {
                evaluasi: 'Gunakan kalimat yang lebih pendek dan sederhana saat memberikan instruksi.',
                orangTua: 'Gunakan bahasa yang sederhana and ulangi instruksi jika anak belum paham.'
            },
            mengikutiSebagian: {
                evaluasi: 'Bantu anak menyelesaikan sisa instruksi yang belum dipahami.',
                orangTua: 'Jika anak hanya melakukan separuh tugas, bimbing dia untuk menyelesaikan sisanya.'
            }
        },
        sensori: {
            tenangDiselimuti: {
                evaluasi: 'Gunakan teknik deep pressure (seperti diselimuti) di awal atau saat anak mulai regulasi diri menurun.',
                orangTua: 'Jika anak mulai tidak tenang di rumah, coba berikan pelukan erat atau selimuti dia untuk menenangkannya.'
            },
            massageOral: {
                evaluasi: 'Lanjutkan program massage oralmotor untuk menurunkan hipersensitivitas area mulut.',
                orangTua: 'Lanjutkan pijatan lembut di area pipi dan sekitar mulut anak seperti yang diajarkan terapis.'
            },
            sikatSensori: {
                evaluasi: 'Lanjutkan sikat sensori untuk membantu regulasi sistem taktil.',
                orangTua: 'Gunakan sikat sensori pada tangan dan kaki anak secara rutin di rumah.'
            },
            usapanAir: {
                evaluasi: 'Gunakan media air sebagai reward atau sarana regulasi jika anak mulai tidak tenang.',
                orangTua: 'Bermain air bisa jadi sarana menenangkan anak di rumah jika dia mulai rewel.'
            },
            visualBubbles: {
                evaluasi: 'Manfaatkan stimulasi visual (seperti bubbles) untuk menarik perhatian dan kontak mata.',
                orangTua: 'Gunakan mainan tiup balon sabun (bubbles) untuk melatih kontak mata anak di rumah.'
            },
            mencariStimulasi: {
                evaluasi: 'Sediakan aktivitas yang memenuhi kebutuhan sensorinya (sensory diet) sebelum masuk ke tugas inti.',
                orangTua: 'Beri anak aktivitas fisik (seperti melompat atau merangkak) sebelum memintanya duduk belajar.'
            },
            menolakTaktil: {
                evaluasi: 'Lakukan desensitisasi taktil secara bertahap dan jangan dipaksakan.',
                orangTua: 'Jangan paksa anak menyentuh benda yang dia takuti (seperti pasir/lem), kenalkan pelan-pelan saja.'
            }
        },
        perilakuMood: {
            bersembunyi: {
                evaluasi: 'Beri ruang aman (safe space) sejenak dan jangan dipaksa langsung berinteraksi jika anak bersembunyi.',
                orangTua: 'Biarkan anak di tempat amannya sejenak jika dia sedang mogok, jangan langsung dimarahi.'
            },
            mencubitMenolak: {
                evaluasi: 'Alihkan perilaku agresif/penolakan ke aktivitas fisik atau manipulasi objek yang aman.',
                orangTua: 'Jika anak mulai mencubit saat menolak, alihkan tangannya untuk meremas mainan kenyal.'
            },
            moodKurangBaik: {
                evaluasi: 'Sesuaikan target terapi hari ini dengan kondisi mood anak, fokus pada regulasi emosi.',
                orangTua: 'Jika mood anak sedang tidak baik di rumah, prioritaskan untuk menenangkannya dulu.'
            }
        },
        latihanFisik: {
            motorikKasar: {
                evaluasi: 'Lanjutkan latihan motorik kasar untuk meningkatkan kekuatan otot dan koordinasi.',
                orangTua: 'Ajak anak bermain aktif di rumah seperti melompat, merangkak, atau melempar bola.'
            },
            koordinasiMataTangan: {
                evaluasi: 'Fokus pada latihan koordinasi mata-tangan untuk mendukung kemandirian aktivitas harian.',
                orangTua: 'Latih anak memasukkan benda ke dalam wadah atau menyusun balok di rumah.'
            },
            keseimbanganPostur: {
                evaluasi: 'Lanjutkan latihan stabilitas postur and keseimbangan untuk kontrol tubuh yang lebih baik.',
                orangTua: 'Latih keseimbangan anak dengan memintanya berdiri satu kaki atau berjalan di garis lurus.'
            },
            latihanKeseimbangan: {
                evaluasi: 'Tingkatkan kesulitan latihan keseimbangan (misal: berdiri satu kaki) secara bertahap.',
                orangTua: 'Tantang keseimbangan anak dengan bermain patung-patungan berdiri satu kaki di rumah.'
            },
            latihanKoordinasi: {
                evaluasi: 'Lanjutkan latihan koordinasi bilateral (menggunakan kedua sisi tubuh).',
                orangTua: 'Ajak anak bertepuk tangan atau menangkap bola besar dengan kedua tangannya.'
            },
            penguatanOtot: {
                evaluasi: 'Prioritaskan latihan penguatan otot core untuk mendukung ketahanan duduk.',
                orangTua: 'Ajak anak bermain dalam posisi tengkurap (tummy time) atau merangkak untuk menguatkan ototnya.'
            },
            polaJalan: {
                evaluasi: 'Latih kesadaran tubuh (proprioceptif) untuk memperbaiki pola jalan.',
                orangTua: 'Minta anak berjalan tanpa alas kaki di berbagai permukaan (lantai, rumput, karpet).'
            }
        }
    },
    generatedText: '',
    generatedOrangTua: '',
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
    <input type="hidden" name="pilihan_respons" :value="JSON.stringify(choices)">
    {{-- Terapis (Read-only) --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis Pelaksana</label>
        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <i data-lucide="stethoscope" class="w-4 h-4 text-blue-500"></i>
            <span class="text-sm font-black text-slate-700 uppercase">{{ $kunjungan->terapis->nama }}</span>
        </div>
        <input type="hidden" name="kunjungan_id" value="{{ $kunjungan->id }}">
    </div>

    {{-- Program Items --}}
    <div id="form-fisioterapi" class="space-y-4">
        <div class="container-form space-y-4">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Program Fisioterapi <span class="text-red-500">*</span></label>
                    <select class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none select2" name="program_id[0]">
                        @foreach ($program_fisioterapi as $f)
                            <option value="{{ $f->id }}">{{ $f->deskripsi }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" id="add-button-fisioterapi" class="shrink-0 mt-5 flex items-center gap-2 px-4 py-3 bg-slate-900 hover:bg-black text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah
                </button>
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Aktivitas Terapi</label>
                <textarea name="aktivitas_terapi[0]" rows="3"
                          class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none resize-none placeholder:text-slate-300"
                          placeholder="Deskripsikan aktivitas terapi yang dilakukan..."></textarea>
                @error('aktivitas_terapi') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Dropdowns untuk Auto-Fill --}}
    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 space-y-4">
        <div class="flex items-center justify-between mb-2">
            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilihan Respons Cepat</label>
            <span class="text-[9px] font-black text-blue-500 uppercase">Auto-Fill Evaluasi</span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Aktivitas di Kelas -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Aktivitas di Kelas</label>
                <select x-model="choices.aktivitasKelas" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="aktifBerlari">Aktif Berlari</option>
                    <option value="aktifBerjalan">Aktif Berjalan</option>
                    <option value="dudukTenang">Duduk Tenang</option>
                    <option value="masihAktif">Masih Tampak Aktif</option>
                    <option value="berpindahAktivitas">Cepat Berpindah Aktivitas</option>
                    <option value="eksplorasiAktif">Eksplorasi Aktif</option>
                    <option value="menolakBerpartisipasi">Menolak Berpartisipasi</option>
                </select>
            </div>

            <!-- Respons Tugas -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Respons Tugas</label>
                <select x-model="choices.responsTugas" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="denganBantuan">Dengan Bantuan</option>
                    <option value="denganBaik">Dengan Baik</option>
                    <option value="awalSampaiSelesai">Dari Awal Sampai Selesai</option>
                    <option value="mandiriSebagian">Mandiri Sebagian</option>
                    <option value="perluPrompt">Perlu Prompt</option>
                </select>
            </div>

            <!-- Fokus & Kontak Mata -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Fokus & Kontak Mata</label>
                <select x-model="choices.fokusKontakMata" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="fokusKontakMataMembaik">Fokus & Kontak Mata Membaik</option>
                    <option value="kontakMataMembaik">Kontak Mata Membaik</option>
                    <option value="mudahTerdistraksi">Mudah Terdistraksi</option>
                    <option value="fokusSingkat">Fokus Singkat</option>
                    <option value="mudahTeralihkan">Mudah Teralihkan</option>
                </select>
            </div>

            <!-- Respons Instruksi -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Respons Instruksi</label>
                <select x-model="choices.responInstruksi" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="ikutiInstruksiBaik">Ikuti Instruksi dengan Baik</option>
                    <option value="perluPengulangan">Perlu Pengulangan</option>
                    <option value="mengikutiSebagian">Mengikuti Sebagian</option>
                </select>
            </div>

            <!-- Sensori / Regulasi -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Sensori / Regulasi</label>
                <select x-model="choices.sensori" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="tenangDiselimuti">Tenang Saat Diselimuti</option>
                    <option value="massageOral">Massage Oralmotor</option>
                    <option value="sikatSensori">Sikat Sensori</option>
                    <option value="usapanAir">Usapan Air (Taktil)</option>
                    <option value="visualBubbles">Visual Bubbles</option>
                    <option value="mencariStimulasi">Mencari Stimulasi</option>
                    <option value="menolakTaktil">Menolak Taktil</option>
                </select>
            </div>

            <!-- Perilaku & Mood -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Perilaku & Mood</label>
                <select x-model="choices.perilakuMood" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="bersembunyi">Bersembunyi/Berbaring</option>
                    <option value="mencubitMenolak">Mencubit/Menolak</option>
                    <option value="moodKurangBaik">Mood Kurang Baik</option>
                </select>
            </div>

            <!-- Aktivitas / Latihan Fisik -->
            <div class="space-y-1">
                <label class="text-[9px] font-black text-slate-500 uppercase">Aktivitas / Latihan Fisik</label>
                <select x-model="choices.latihanFisik" @change="updateText()" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
                    <option value="">-- Pilih --</option>
                    <option value="motorikKasar">Latihan Motorik Kasar</option>
                    <option value="koordinasiMataTangan">Koordinasi Mata-Tangan</option>
                    <option value="keseimbanganPostur">Keseimbangan & Postur</option>
                    <option value="latihanKeseimbangan">Latihan Keseimbangan</option>
                    <option value="latihanKoordinasi">Latihan Koordinasi</option>
                    <option value="penguatanOtot">Penguatan Otot Core</option>
                    <option value="polaJalan">Latihan Pola Jalan</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Hasil Seluruh Kegiatan --}}
    <div class="space-y-1">
        <label class="text-[9px] font-black text-slate-500 uppercase">Hasil Seluruh Kegiatan Terapi</label>
        <select name="hasil_kegiatan" x-model="choices.hasilKegiatan" class="w-full bg-white border-slate-100 rounded-xl px-4 py-2.5 text-xs font-bold focus:ring-2 focus:ring-blue-50 transition-all outline-none">
            <option value="baik">Menyelesaikan sesi dengan baik</option>
            <option value="cukup">Menyelesaikan sesi dengan cukup baik</option>
            <option value="kurang">Belum mampu menyelesaikan sesi dengan baik</option>
        </select>
    </div>

    {{-- Evaluasi --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Evaluasi Sesi <span class="text-red-500">*</span></label>
        <textarea name="evaluasi" rows="6" required
                  x-model="generatedText"
                  @keydown.enter.prevent="handleEnter($event, 'generatedText')"
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Evaluasi perkembangan fisioterapi..."></textarea>
        @error('evaluasi') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Catatan Khusus --}}
    <div class="space-y-2">
        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan untuk Orang Tua di Rumah</label>
        <textarea name="catatan_khusus" rows="4"
                  x-model="generatedOrangTua"
                  @keydown.enter.prevent="handleEnter($event, 'generatedOrangTua')"
                  class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none resize-none placeholder:text-slate-300"
                  placeholder="Saran latihan di rumah untuk orang tua..."></textarea>
        @error('catatan_khusus') <p class="text-[10px] font-black text-red-500">{{ $message }}</p> @enderror
    </div>

    {{-- Actions --}}
    <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
        <a href="{{ url()->previous() }}" class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
        <button type="submit" class="px-12 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl transition-all">{{ $tombol }}</button>
    </div>
</div>
