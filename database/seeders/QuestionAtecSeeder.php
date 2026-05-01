<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionAtecSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // Bagian I: Komunikasi/Bahasa (14)
            ['section' => 'I', 'no_urut' => 1, 'question_text' => 'Tahu namanya sendiri'],
            ['section' => 'I', 'no_urut' => 2, 'question_text' => 'Merespon terhadap "Tidak" atau "Berhenti"'],
            ['section' => 'I', 'no_urut' => 3, 'question_text' => 'Dapat mengikuti beberapa perintah'],
            ['section' => 'I', 'no_urut' => 4, 'question_text' => 'Bisa menggunakan satu kata sekaligus (Tidak, Makan, Air, dll.)'],
            ['section' => 'I', 'no_urut' => 5, 'question_text' => 'Bisa menggunakan dua kata sekaligus (Tidak mau, Pergi sana, dll.)'],
            ['section' => 'I', 'no_urut' => 6, 'question_text' => 'Bisa menggunakan tiga kata sekaligus (Saya mau susu, dll.)'],
            ['section' => 'I', 'no_urut' => 7, 'question_text' => 'Tahu 10 kata atau lebih'],
            ['section' => 'I', 'no_urut' => 8, 'question_text' => 'Bisa menggunakan kalimat dengan 4 kata atau lebih'],
            ['section' => 'I', 'no_urut' => 9, 'question_text' => 'Mampu menjelaskan apa yang dia inginkan'],
            ['section' => 'I', 'no_urut' => 10, 'question_text' => 'Mampu bertanya pertanyaan bermakna'],
            ['section' => 'I', 'no_urut' => 11, 'question_text' => 'Ucapannya cenderung bermakna/relevan'],
            ['section' => 'I', 'no_urut' => 12, 'question_text' => 'Sering menggunakan kalimat yang cukup kompleks'],
            ['section' => 'I', 'no_urut' => 13, 'question_text' => 'Mampu melangsungkan percakapan dengan baik'],
            ['section' => 'I', 'no_urut' => 14, 'question_text' => 'Memiliki kemampuan komunikasi normal untuk usianya'],

            // Bagian II: Sosialisasi (20)
            ['section' => 'II', 'no_urut' => 1, 'question_text' => 'Tampak seperti berada dalam tempurung/dunianya sendiri'],
            ['section' => 'II', 'no_urut' => 2, 'question_text' => 'Mengabaikan orang lain'],
            ['section' => 'II', 'no_urut' => 3, 'question_text' => 'Sedikit atau tidak memperhatikan ketika diajak bicara'],
            ['section' => 'II', 'no_urut' => 4, 'question_text' => 'Tidak kooperatif atau melawan'],
            ['section' => 'II', 'no_urut' => 5, 'question_text' => 'Tidak melakukan kontak mata'],
            ['section' => 'II', 'no_urut' => 6, 'question_text' => 'Lebih suka menyendiri'],
            ['section' => 'II', 'no_urut' => 7, 'question_text' => 'Tidak menunjukkan kasih sayang'],
            ['section' => 'II', 'no_urut' => 8, 'question_text' => 'Tidak menyapa orang tua'],
            ['section' => 'II', 'no_urut' => 9, 'question_text' => 'Menghindari kontak fisik (sentuhan)'],
            ['section' => 'II', 'no_urut' => 10, 'question_text' => 'Tidak mau meniru atau tidak bisa bermain tiruan'],
            ['section' => 'II', 'no_urut' => 11, 'question_text' => 'Tidak suka digendong/dipeluk'],
            ['section' => 'II', 'no_urut' => 12, 'question_text' => 'Tidak berbagi kesenangan/berbagi senyum'],
            ['section' => 'II', 'no_urut' => 13, 'question_text' => 'Tampak kaku jika dipegang'],
            ['section' => 'II', 'no_urut' => 14, 'question_text' => 'Sering tantrum (mengamuk)'],
            ['section' => 'II', 'no_urut' => 15, 'question_text' => 'Tidak merespon panggilan namanya'],
            ['section' => 'II', 'no_urut' => 16, 'question_text' => 'Tidak bisa bermain dengan anak lain'],
            ['section' => 'II', 'no_urut' => 17, 'question_text' => 'Tidak bisa diajak bergiliran/antre'],
            ['section' => 'II', 'no_urut' => 18, 'question_text' => 'Hanya memperhatikan sebagian dari seseorang (misal: hanya melihat tangan)'],
            ['section' => 'II', 'no_urut' => 19, 'question_text' => 'Tidak menginisiasi pembicaraan/interaksi'],
            ['section' => 'II', 'no_urut' => 20, 'question_text' => 'Jarang membalas senyum orang lain'],

            // Bagian III: Kesadaran Sensorik/Kognitif (18)
            ['section' => 'III', 'no_urut' => 1, 'question_text' => 'Merespon saat dipanggil namanya'],
            ['section' => 'III', 'no_urut' => 2, 'question_text' => 'Merespon pujian'],
            ['section' => 'III', 'no_urut' => 3, 'question_text' => 'Melihat ke arah orang atau hewan peliharaan (Visual)'],
            ['section' => 'III', 'no_urut' => 4, 'question_text' => 'Melihat gambar (dan tv)'],
            ['section' => 'III', 'no_urut' => 5, 'question_text' => 'Bisa menggambar, mewarnai, atau berkreasi'],
            ['section' => 'III', 'no_urut' => 6, 'question_text' => 'Bermain dengan mainan secara tepat'],
            ['section' => 'III', 'no_urut' => 7, 'question_text' => 'Memiliki ekspresi wajah yang sesuai'],
            ['section' => 'III', 'no_urut' => 8, 'question_text' => 'Memahami tayangan TV / cerita yang dibacakan'],
            ['section' => 'III', 'no_urut' => 9, 'question_text' => 'Memahami penjelasan-penjelasan'],
            ['section' => 'III', 'no_urut' => 10, 'question_text' => 'Sadar akan lingkungannya'],
            ['section' => 'III', 'no_urut' => 11, 'question_text' => 'Sadar akan bahaya'],
            ['section' => 'III', 'no_urut' => 12, 'question_text' => 'Menunjukkan imajinasi/bermain imajinatif'],
            ['section' => 'III', 'no_urut' => 13, 'question_text' => 'Sering menginisiasi berbagai aktivitas'],
            ['section' => 'III', 'no_urut' => 14, 'question_text' => 'Bisa berpakaian mandiri'],
            ['section' => 'III', 'no_urut' => 15, 'question_text' => 'Miliki rasa ingin tahu / ketertarikan'],
            ['section' => 'III', 'no_urut' => 16, 'question_text' => 'Mampu mengeksplorasi secara visual dan taktil'],
            ['section' => 'III', 'no_urut' => 17, 'question_text' => 'Pandangannya menatap tajam di tempat/sesuai tujuan'],
            ['section' => 'III', 'no_urut' => 18, 'question_text' => 'Merespon suara/pendengaran di sekitarnya'],

            // Bagian IV: Kesehatan/Fisik/Perilaku (25)
            ['section' => 'IV', 'no_urut' => 1, 'question_text' => 'Masalah Mengompol (Ngompol malam/siang)'],
            ['section' => 'IV', 'no_urut' => 2, 'question_text' => 'Buang air besar di celana'],
            ['section' => 'IV', 'no_urut' => 3, 'question_text' => 'Diare berlebihan'],
            ['section' => 'IV', 'no_urut' => 4, 'question_text' => 'Sembelit berlebihan'],
            ['section' => 'IV', 'no_urut' => 5, 'question_text' => 'Masalah gangguan tidur'],
            ['section' => 'IV', 'no_urut' => 6, 'question_text' => 'Suka makan/minum sembarangan yang bukan makanan'],
            ['section' => 'IV', 'no_urut' => 7, 'question_text' => 'Sangat pemilih makanan (Picky eater)'],
            ['section' => 'IV', 'no_urut' => 8, 'question_text' => 'Sangat hiperaktif/Sulit diam'],
            ['section' => 'IV', 'no_urut' => 9, 'question_text' => 'Sangat lesu/kekurangan energi'],
            ['section' => 'IV', 'no_urut' => 10, 'question_text' => 'Sering memukul atau menyakiti diri sendiri'],
            ['section' => 'IV', 'no_urut' => 11, 'question_text' => 'Sering memukul atau menyakiti orang lain'],
            ['section' => 'IV', 'no_urut' => 12, 'question_text' => 'Merusak perabotan/barang'],
            ['section' => 'IV', 'no_urut' => 13, 'question_text' => 'Sensitif terhadap suara keras'],
            ['section' => 'IV', 'no_urut' => 14, 'question_text' => 'Cemas/Ketakutan berlebihan'],
            ['section' => 'IV', 'no_urut' => 15, 'question_text' => 'Tampak selalu sedih atau menangis'],
            ['section' => 'IV', 'no_urut' => 16, 'question_text' => 'Tertawa tiba-tiba tanpa alasan jelas'],
            ['section' => 'IV', 'no_urut' => 17, 'question_text' => 'Peka atau sensitif berlebih (mudah tersinggung/rewel)'],
            ['section' => 'IV', 'no_urut' => 18, 'question_text' => 'Berfokus/terobsesi pada objek/benda tertentu'],
            ['section' => 'IV', 'no_urut' => 19, 'question_text' => 'Gerakan tangan berulang (Hand-flapping)'],
            ['section' => 'IV', 'no_urut' => 20, 'question_text' => 'Tampak kaku pada rutinitas (Marah jika rutinitas berubah)'],
            ['section' => 'IV', 'no_urut' => 21, 'question_text' => 'Berteriak atau memekik'],
            ['section' => 'IV', 'no_urut' => 22, 'question_text' => 'Suka menyendiri / Mengisolasi diri'],
            ['section' => 'IV', 'no_urut' => 23, 'question_text' => 'Tidak peka / Menolak nyeri fisik'],
            ['section' => 'IV', 'no_urut' => 24, 'question_text' => 'Suka mengulangi kata / membeo (Echolalia)'],
            ['section' => 'IV', 'no_urut' => 25, 'question_text' => 'Pandangan kosong ke satu titik'],
        ];

        DB::table('question_atecs')->insert($questions);
    }
}
