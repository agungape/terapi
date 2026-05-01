<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionAutis;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('question_autis')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $questions = [
            // Section A: Wawancara Orang Tua (A1-A9)
            ['no_urut' => 1, 'section' => 'A', 'question_text' => 'Apakah anak anda suka diayun-ayun, digendong, dll.?'],
            ['no_urut' => 2, 'section' => 'A', 'question_text' => 'Apakah anak anda tertarik pada anak-anak lain?'],
            ['no_urut' => 3, 'section' => 'A', 'question_text' => 'Apakah anak anda suka memanjat, seperti memanjat tangga?'],
            ['no_urut' => 4, 'section' => 'A', 'question_text' => 'Apakah anak anda suka main "peek-a-boo" (ciluk ba) / petak umpet?'],
            ['no_urut' => 5, 'section' => 'A', 'question_text' => 'Apakah anak anda pernah bermain pura-pura, seperti pura-pura bicara di telepon?'],
            ['no_urut' => 6, 'section' => 'A', 'question_text' => 'Apakah anak anda pernah menggunakan jarinya untuk menunjuk, meminta sesuatu?'],
            ['no_urut' => 7, 'section' => 'A', 'question_text' => 'Apakah anak anda pernah menggunakan jarinya untuk menunjuk tertarik pada sesuatu?'],
            ['no_urut' => 8, 'section' => 'A', 'question_text' => 'Apakah anak anda bisa bermain dengan mainan kecil seperti mobil atau kubus?'],
            ['no_urut' => 9, 'section' => 'A', 'question_text' => 'Apakah anak anda pernah menunjukkan sesuatu kepada anda?'],

            // Section B: Observasi Terapis (B1-B5)
            ['no_urut' => 10, 'section' => 'B', 'question_text' => 'Apakah anak mau menatap mata (eye contact) selama wawancara?'],
            ['no_urut' => 11, 'section' => 'B', 'question_text' => 'Dapatkah anda menarik perhatian anak, lalu mengarahkan pandangannya ke benda tertentu?'],
            ['no_urut' => 12, 'section' => 'B', 'question_text' => 'Dapatkah anda menarik perhatian anak dengan cara bermain pura-pura?'],
            ['no_urut' => 13, 'section' => 'B', 'question_text' => 'Apakah anak mengerti instruksi sederhana (misal: "taruh kubus di atas meja")?'],
            ['no_urut' => 14, 'section' => 'B', 'question_text' => 'Apakah anak dapat bermain pura-pura minum dari cangkir kosong?'],
        ];

        foreach ($questions as $q) {
            QuestionAutis::create($q);
        }
    }
}
