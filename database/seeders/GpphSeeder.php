<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionGpph;
use Illuminate\Support\Facades\DB;

class GpphSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('question_gpphs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $questions = [
            ['question_text' => 'Tidak kenal lelah, atau aktivitas berlebihan'],
            ['question_text' => 'Mudah menjadi gembira, impulsif'],
            ['question_text' => 'Mengganggu anak-anak lain'],
            ['question_text' => 'Gagal menyelesaikan kegiatan yang telah dimulai, rentang perhatian pendek'],
            ['question_text' => 'Menggerak-gerakkan anggota badan atau kepala secara terus-menerus'],
            ['question_text' => 'Kurang perhatian, mudah teralihkan'],
            ['question_text' => 'Permintaannya harus segera dipenuhi, mudah menjadi frustrasi'],
            ['question_text' => 'Sering dan mudah menangis'],
            ['question_text' => 'Suasana hatinya mudah berubah dengan cepat dan drastis'],
            ['question_text' => 'Ledakan kemarahan, tingkah laku eksplosif dan tidak terduga'],
        ];

        foreach ($questions as $q) {
            QuestionGpph::create($q);
        }
    }
}
