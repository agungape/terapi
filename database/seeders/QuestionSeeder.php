<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AgeGroup;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group1 = AgeGroup::create(['nama' => '0-6 bulan']);
        $group2 = AgeGroup::create(['nama' => '7-12 bulan']);

        $group1->questions()->createMany([
            [
                'question_text' => 'Apakah bayi Anda merespon suara keras?',
            ],
            [
                'question_text' => 'Apakah bayi Anda tetap diam ketika mendengar suara keras?',
            ]
        ]);

        $group2->questions()->createMany([
            [
                'question_text' => 'Apakah anak Anda menoleh saat dipanggil namanya?',
            ],
            [
                'question_text' => 'Apakah anak Anda tidak bereaksi terhadap suara sekitarnya?',
            ]
        ]);
    }
}
