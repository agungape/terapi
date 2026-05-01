# Analisis Form Observasi & Rencana Redesign Berbasis Standar Kemenkes RI

> **Tujuan:** Menganalisis seluruh form observasi yang ada, lalu merancang ulang berdasarkan standar **Deteksi Dini Tumbuh Kembang Anak** sesuai **Pedoman Kemenkes RI (Permenkes No. 66 Tahun 2014 dan Buku Pedoman SDIDTK)**

---

## BAGIAN 1 — KONDISI FORM SAAT INI

### Ringkasan Modul Observasi yang Ada

| No | Nama Form | Lokasi View | Instrumen | Skoring | Status |
|----|-----------|-------------|-----------|---------|--------|
| 1 | **M-CHAT** | `observasi/show.blade.php` modal `autis` | Custom pertanyaan Ya/Tidak | ≥2 jawaban "Tidak" = Risiko | ⚠️ Tidak standar |
| 2 | **GPPH** | Modal `gpph` | Custom 10 pertanyaan, skala 0-3 | Total ≥13 = Kemungkinan GPPH | ⚠️ Tidak standar |
| 3 | **KMPE** | Modal `perilaku` | Custom Ya/Tidak | ≥2 jawaban "Ya" | ⚠️ Tidak standar |
| 4 | **Pendengaran** | Modal `pendengaran` | Kelompok umur, Ya/Tidak | ≥1 "Tidak" = Penyimpangan | ⚠️ Tidak standar |
| 5 | **Penglihatan** | Modal `penglihatan` | Pilih kategori interpretasi | Radio pilihan | ⚠️ Tidak standar |
| 6 | **ATEC** | Modal `atec` | Upload gambar eksternal | Manual | ❌ Tidak relevan untuk SDIDTK |
| 7 | **Wawancara/Anamnesis** | Modal `atec` | Textarea bebas | Kualitatif | ⚠️ Kurang terstruktur |
| 8 | **Obs. Perilaku** | Sidebar card | Summernote rich text | Kualitatif | ✅ Relevan tapi kurang terstruktur |
| 9 | **Obs. Sensorik** | Sidebar card | Summernote rich text | Kualitatif | ✅ Relevan tapi kurang terstruktur |

---

### Masalah Utama pada Form Saat Ini

> [!WARNING]
> **Tidak sesuai standar Kemenkes SDIDTK** — Instrumen yang digunakan tidak mengacu pada buku pedoman resmi Kemenkes RI, sehingga hasil deteksi tidak dapat digunakan sebagai dasar klinis yang sah.

1. **M-CHAT yang digunakan tidak sesuai standar** — Kemenkes menggunakan **KPSP** sebagai instrumen utama skrining perkembangan. M-CHAT hanya untuk usia 18-24 bulan. Yang benar digunakan adalah **CHAT** versi standar Kemenkes (Section A + B).

2. **GPPH mendekati standar namun pertanyaan perlu diupdate** — Skala 0-3 dan ambang batas ≥13 sudah benar. Namun, 10 pertanyaan harus disesuaikan dengan 10 item standar Kemenkes.

3. **Tidak ada instrumen KPSP** — Instrumen paling utama dalam SDIDTK Kemenkes adalah KPSP (10 pertanyaan per kelompok usia), namun TIDAK ADA dalam sistem. Ini adalah kekurangan terbesar.

4. **Tidak ada data pertumbuhan fisik (Anthropometri)** — SDIDTK mencakup pengukuran BB/TB/LK, namun tidak ada formulir untuk ini.

5. **KMPE tidak standar** — Kemenkes menggunakan **KMME** dengan 12 pertanyaan spesifik.

6. **Pendengaran (TDD) dan Penglihatan (TDL)** — Struktur sudah ada, namun pertanyaan belum mengacu pada standar Kemenkes.

7. **ATEC upload gambar** — Tidak efektif, sebaiknya diganti dengan form digital atau dihapus.

---

## BAGIAN 2 — STANDAR KEMENKES RI (SDIDTK)

### Landasan Hukum

- **Permenkes No. 66 Tahun 2014** tentang Pemantauan Pertumbuhan, Perkembangan, dan Gangguan Tumbuh Kembang Anak
- **Buku Pedoman Pelaksanaan SDIDTK** (Stimulasi, Deteksi, dan Intervensi Dini Tumbuh Kembang Anak)
- **KMK No. 828 Tahun 2008** tentang Pedoman Penyelenggaraan SDIDTK

### 7 Instrumen Wajib Kemenkes SDIDTK

| No | Instrumen | Singkatan | Tujuan | Kelompok Usia |
|----|-----------|-----------|--------|---------------|
| 1 | **Kuesioner Pra Skrining Perkembangan** | **KPSP** | Deteksi penyimpangan perkembangan | 3 bln — 72 bln |
| 2 | **Tes Daya Dengar** | **TDD** | Deteksi gangguan pendengaran | 0 — 72 bln |
| 3 | **Tes Daya Lihat** | **TDL** | Deteksi gangguan penglihatan | 36 — 72 bln |
| 4 | **Kuesioner Masalah Mental Emosional** | **KMME** | Deteksi masalah mental emosional | 36 — 72 bln |
| 5 | **Checklist for Autism in Toddlers** | **CHAT** | Deteksi dini autisme | 18 — 36 bln |
| 6 | **Gangguan Pemusatan Perhatian & Hiperaktivitas** | **GPPH** | Deteksi GPPH | 36 bln ke atas |
| 7 | **Pertumbuhan Fisik (Anthropometri)** | **BB/TB/LK** | Pemantauan pertumbuhan fisik | Semua usia |

---

## BAGIAN 3 — DETAIL FORM BARU SESUAI KEMENKES

### 3.1 KPSP (Kuesioner Pra Skrining Perkembangan) — PRIORITAS UTAMA

**Deskripsi:** Berisi 10 pertanyaan per kelompok umur (16 kelompok usia dari 3 hingga 72 bulan).

**Kelompok Usia:** 3, 6, 9, 12, 15, 18, 21, 24, 30, 36, 42, 48, 54, 60, 66, 72 bulan

**Bidang Perkembangan:**
- **PS** = Personal-Sosial
- **MH** = Motorik Halus
- **B** = Bahasa
- **MK** = Motorik Kasar

**Interpretasi:**
- Jawaban "Ya" = 9 atau 10 → **Sesuai (S)**
- Jawaban "Ya" = 7 atau 8 → **Meragukan (M)** → Ulangi setelah 2 minggu
- Jawaban "Ya" ≤ 6 → **Penyimpangan (P)** → Rujuk

**Database yang dibutuhkan:**
```sql
CREATE TABLE kpsp_kelompok_usia (
    id, nama_kelompok, usia_bulan, kode
);
CREATE TABLE kpsp_pertanyaan (
    id, kelompok_usia_id, no_urut, pertanyaan, bidang
);
CREATE TABLE kpsp_jawaban (
    id, anak_id, kelompok_usia_id, tanggal,
    total_ya, interpretasi, catatan
);
```

---

### 3.2 TDD (Tes Daya Dengar) — Ganti Form Pendengaran

**Format:** Pertanyaan per kelompok usia, jawab Ya/Tidak.

**Interpretasi:** Satu jawaban "Tidak" saja → kemungkinan gangguan pendengaran → rujuk.

**Struktur form saat ini sudah mendekati** — hanya perlu update pertanyaan menjadi standar TDD Kemenkes.

---

### 3.3 TDL (Tes Daya Lihat) — Ganti Form Penglihatan

**Usia:** 36 — 72 bulan (menggunakan Kartu E / Optotype E).

**Prosedur:**
1. Kartu E ditempel setinggi mata anak, jarak 3 meter
2. Anak menunjukkan arah kaki huruf E
3. Lakukan tiap baris, mulai baris pertama hingga baris ketiga
4. Test tiap mata bergantian (tutup satu mata)

**Interpretasi:**
- Bisa baris ke-3 → **Normal**
- Tidak bisa baris ke-3 → **Curiga gangguan penglihatan**

---

### 3.4 KMME (Kuesioner Masalah Mental Emosional) — Ganti KMPE

**Usia:** 36 — 72 bulan. **12 pertanyaan**, jawab Ya/Tidak.

**12 Pertanyaan Standar Kemenkes:**

| No | Pertanyaan |
|----|-----------|
| 1 | Apakah anak anda seringkali terlihat marah tanpa sebab yang jelas? |
| 2 | Apakah anak anda tampak menghindari bermain bersama teman-teman atau saudara-saudaranya? |
| 3 | Apakah anak anda terlihat bersedih (murung) atau menarik diri? |
| 4 | Apakah anak anda terlihat takut atau sangat cemas? |
| 5 | Apakah anak anda mengalami gangguan tidur seperti sulit tidur, sering terbangun, atau mimpi buruk? |
| 6 | Apakah anak anda seringkali mengompol pada siang hari? |
| 7 | Apakah anak anda seringkali buang air besar di celana? |
| 8 | Apakah anak anda mempunyai kebiasaan menggigit kuku, mencabut rambut, atau menghisap jari? |
| 9 | Apakah anak anda sering mengeluh sakit kepala, sakit perut, atau keluhan fisik lainnya? |
| 10 | Apakah anak anda mudah teralih perhatiannya atau tidak dapat berkonsentrasi? |
| 11 | Apakah anak anda seringkali terlihat gelisah dan tidak dapat duduk tenang? |
| 12 | Apakah anak anda sering berbicara/bertindak terlalu aktif (hiperaktif)? |

**Interpretasi:** ≥2 jawaban "Ya" → kemungkinan masalah mental emosional → rujuk

---

### 3.5 CHAT (Checklist for Autism in Toddlers) — Ganti M-CHAT

**Usia:** 18 — 36 bulan. Dua bagian: Section A (9 item, orang tua) + Section B (5 item, terapis).

**Section A — Pertanyaan ke Orang Tua:**

| No | Pertanyaan |
|----|-----------|
| A1 | Apakah anak anda suka diayun-ayun, digendong, dll.? |
| A2 | Apakah anak anda tertarik pada anak-anak lain? |
| A3 | Apakah anak anda suka memanjat, seperti memanjat tangga? |
| A4 | Apakah anak anda suka main "peek-a-boo" (ciluk ba) / petak umpet? |
| A5 | Apakah anak anda pernah bermain pura-pura, seperti pura-pura bicara di telepon? |
| A6 | Apakah anak anda pernah menggunakan jarinya untuk menunjuk, meminta sesuatu? |
| A7 | Apakah anak anda pernah menggunakan jarinya untuk menunjuk tertarik pada sesuatu? |
| A8 | Apakah anak anda bisa bermain dengan mainan kecil seperti mobil atau kubus? |
| A9 | Apakah anak anda pernah menunjukkan sesuatu kepada anda? |

**Section B — Observasi Langsung Terapis:**

| No | Pertanyaan |
|----|-----------|
| B1 | Apakah anak mau menatap mata (eye contact) selama wawancara? |
| B2 | Dapatkan anda menarik perhatian anak, lalu mengarahkan pandangannya ke benda tertentu? |
| B3 | Dapatkan anda menarik perhatian anak dengan cara bermain pura-pura? |
| B4 | Apakah anak mengerti instruksi sederhana (misal: "taruh kubus di atas meja")? |
| B5 | Apakah anak dapat bermain pura-pura minum dari cangkir kosong? |

**Interpretasi Risiko Tinggi:** Jawaban "Tidak" pada A5, A7, B2, B3, atau B4 → Rujuk

---

### 3.6 GPPH — Perbaiki Form yang Ada

**Struktur sudah benar** (10 item, skala 0-3, batas ≥13). Hanya perlu **update pertanyaan**.

**10 Pertanyaan GPPH Standar Kemenkes:**

| No | Aspek Pengamatan |
|----|-----------------|
| 1 | Tidak kenal lelah, atau aktivitas berlebihan |
| 2 | Mudah menjadi gembira, impulsif |
| 3 | Mengganggu anak-anak lain |
| 4 | Gagal menyelesaikan kegiatan yang telah dimulai, rentang perhatian pendek |
| 5 | Menggerak-gerakkan anggota badan atau kepala secara terus-menerus |
| 6 | Kurang perhatian, mudah teralihkan |
| 7 | Permintaannya harus segera dipenuhi, mudah menjadi frustrasi |
| 8 | Sering dan mudah menangis |
| 9 | Suasana hatinya mudah berubah dengan cepat dan drastis |
| 10 | Ledakan kemarahan, tingkah laku eksplosif dan tidak terduga |

**Skoring:** 0=Tidak Pernah, 1=Kadang, 2=Sering, 3=Selalu | Batas: **Total ≥13 = Kemungkinan GPPH**

---

### 3.7 Anthropometri (Pertumbuhan Fisik) — MODUL BARU

> [!IMPORTANT]
> Belum ada sama sekali. Ini bagian inti SDIDTK.

**Data yang Perlu Dicatat:**
- Berat Badan (BB) dalam kg
- Tinggi/Panjang Badan (TB/PB) dalam cm
- Lingkar Kepala (LK) dalam cm
- Lingkar Lengan Atas (LLA) dalam cm
- Tanggal pengukuran + usia saat pengukuran

**Interpretasi (kurva WHO):**
- BB/U → Gizi Buruk / Kurang / Normal / Lebih
- TB/U → Sangat Pendek / Pendek / Normal / Tinggi
- BB/TB → Kurus / Normal / Gemuk
- LK/U → Mikrosefali / Normal / Makrosefali

---

## BAGIAN 4 — MATRIKS PERUBAHAN (BEFORE vs AFTER)

| Form Lama | Status | Form Baru Kemenkes | Aksi |
|-----------|--------|--------------------|------|
| M-CHAT (custom) | ❌ Ganti | **CHAT** (Section A + B) | Redesign total |
| GPPH (10 item, skala 0-3) | ⚠️ Perbaiki | **GPPH** (10 item Kemenkes) | Update pertanyaan |
| KMPE | ❌ Ganti | **KMME** (12 item Kemenkes) | Redesign total |
| Pendengaran (kelompok umur) | ⚠️ Perbaiki | **TDD** (Tes Daya Dengar) | Update pertanyaan |
| Penglihatan (pilih kategori) | ⚠️ Perbaiki | **TDL** (Kartu E + prosedur) | Tambah prosedur |
| ATEC (upload gambar) | ❌ Hapus/Ubah | ATEC digital (77 item) | Redesign atau hapus |
| Wawancara/Anamnesis | ⚠️ Perbaiki | Anamnesis SDIDTK terstruktur | Restructure |
| Obs. Perilaku | ✅ Pertahankan | Catatan Klinis Terapis | Label ulang |
| Obs. Sensorik | ✅ Pertahankan | Catatan Klinis Terapis | Label ulang |
| ❌ BELUM ADA | — | **KPSP** (10 pertanyaan/usia) | BUAT BARU — PRIORITAS 1 |
| ❌ BELUM ADA | — | **Anthropometri** (BB/TB/LK) | BUAT BARU — PRIORITAS 2 |

---

## BAGIAN 5 — RENCANA IMPLEMENTASI

### Fase 1 — Database (Prioritas Tinggi)
1. Buat tabel `kpsp_kelompok_usia`, `kpsp_pertanyaan`, `kpsp_jawaban`
2. Buat tabel `anthropometri`
3. Tambah kolom `section` di `question_autis` untuk membedakan Section A/B pada CHAT
4. Rename/refactor `question_perilakus` → data KMME

### Fase 2 — Seed Data
1. Seed 160 pertanyaan KPSP (10 × 16 kelompok usia)
2. Seed 14 pertanyaan CHAT (9 Section A + 5 Section B)
3. Seed/update 12 pertanyaan KMME
4. Seed/update 10 pertanyaan GPPH standar Kemenkes
5. Seed/update pertanyaan TDD per kelompok usia

### Fase 3 — Form & UI Baru
1. **Modal KPSP** — 10 pertanyaan, deteksi otomatis kelompok usia, scoring S/M/P
2. **Modal CHAT** — Dua section terpisah (A: orang tua, B: observasi terapis)
3. **Modal KMME** — 12 pertanyaan Ya/Tidak dengan scoring
4. **Modal TDD** — Per kelompok usia (ganti pendengaran)
5. **Modal TDL** — Panduan prosedur Kartu E + input hasil
6. **Card Anthropometri** — Form BB/TB/LK + riwayat pengukuran

### Fase 4 — PDF & Laporan
1. Update `pdf_hasil.blade.php` menggunakan terminologi Kemenkes
2. Tambahkan bagian KPSP, Anthropometri, dan CHAT di PDF
3. Sertakan grafik pertumbuhan (opsional)

---

## PERTANYAAN KPSP SAMPEL (USIA 12 BULAN)

| No | Pertanyaan | Bidang |
|----|-----------|--------|
| 1 | Jika anda bersembunyi di belakang sesuatu/di pojok, kemudian muncul dan menghilang bergantian, apakah anak mencari atau mengharapkan anda muncul kembali? | PS |
| 2 | Letakkan pensil di telapak tangan anak. Coba ambil perlahan-lahan. Sulitkah mendapatkan pensil itu kembali? | MH |
| 3 | Apakah anak anda dapat berdiri sendiri tanpa berpegangan selama kira-kira 5 detik? | MK |
| 4 | Apakah anak anda dapat berdiri sendiri tanpa berpegangan selama 30 detik atau lebih? | MK |
| 5 | Tanpa berpegangan, apakah anak dapat membungkuk memungut mainan di lantai lalu berdiri kembali? | MK |
| 6 | Apakah anak dapat menunjukkan apa yang diinginkannya tanpa menangis/merengek? (menunjuk, menarik, atau mengeluarkan suara menyenangkan) | B |
| 7 | Apakah anak dapat berjalan sepanjang ruangan tanpa jatuh atau terhuyung-huyung? | MK |
| 8 | Apakah anak dapat mengambil benda kecil seperti kacang dengan meremas di antara ibu jari dan jarinya? | MH |
| 9 | Apakah anak dapat mengucapkan paling sedikit 3 kata yang mempunyai arti selain "papa" dan "mama"? | B |
| 10 | Apakah anak dapat menggunakan 2 kata sekaligus (misal "minta minum", "mau tidur")? | B |

---

## RINGKASAN EKSEKUTIF

> [!NOTE]
> Form saat ini sudah memiliki **struktur teknis yang baik** (modal Alpine.js, CRUD, PDF export). Redesign yang dibutuhkan lebih kepada **penggantian konten pertanyaan** dan **penambahan instrumen baru (KPSP + Anthropometri)**.

**Prioritas Perubahan:**
1. 🔴 **KRITIS** — Tambah instrumen KPSP (belum ada, paling penting)
2. 🔴 **KRITIS** — Tambah form Anthropometri BB/TB/LK (belum ada)
3. 🟡 **PENTING** — Ganti M-CHAT → CHAT Section A + B (standar Kemenkes)
4. 🟡 **PENTING** — Ganti KMPE → KMME (12 pertanyaan standar Kemenkes)
5. 🟢 **DISARANKAN** — Update pertanyaan GPPH sesuai standar Kemenkes
6. 🟢 **DISARANKAN** — Update pertanyaan TDD dan prosedur TDL
7. ⚪ **OPSIONAL** — ATEC digital (77 item) atau pertahankan upload gambar

---

*Dibuat: 26 April 2026 | Referensi: Pedoman SDIDTK Kemenkes RI, 2016*
