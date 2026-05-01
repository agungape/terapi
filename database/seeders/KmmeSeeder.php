<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionPerilaku;
use Illuminate\Support\Facades\DB;

class KmmeSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('question_perilakus')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $questions = [
            ['question_text' => 'Apakah anak anda seringkali terlihat marah tanpa sebab yang jelas?'],
            ['question_text' => 'Apakah anak anda tampak menghindari bermain bersama teman-teman atau saudara-saudaranya?'],
            ['question_text' => 'Apakah anak anda terlihat bersedih (murung) atau menarik diri?'],
            ['question_text' => 'Apakah anak anda terlihat takut atau sangat cemas?'],
            ['question_text' => 'Apakah anak anda mengalami gangguan tidur seperti sulit tidur, sering terbangun, atau mimpi buruk?'],
            ['question_text' => 'Apakah anak anda seringkali mengompol pada siang hari?'],
            ['question_text' => 'Apakah anak anda seringkali buang air besar di celana?'],
            ['question_text' => 'Apakah anak anda mempunyai kebiasaan menggigit kuku, mencabut rambut, atau menghisap jari?'],
            ['question_text' => 'Apakah anak anda sering mengeluh sakit kepala, sakit perut, atau keluhan fisik lainnya?'],
            ['question_text' => 'Apakah anak anda mudah teralih perhatiannya atau tidak dapat berkonsentrasi?'],
            ['question_text' => 'Apakah anak anda seringkali terlihat gelisah dan tidak dapat duduk tenang?'],
            ['question_text' => 'Apakah anak anda sering berbicara/bertindak terlalu aktif (hiperaktif)?'],
        ];

        foreach ($questions as $q) {
            QuestionPerilaku::create($q);
        }
    }
}
