<?php

use App\Models\AlatUkur;

$tools = [
    [
        'nama' => 'M-CHAT-R (Modified Checklist for Autism in Toddlers, Revised)',
        'singkatan' => 'M-CHAT-R',
        'domain' => 'sosial_emosional',
        'min_usia_bulan' => 16,
        'max_usia_bulan' => 30,
        'deskripsi' => 'Alat skrining untuk mendeteksi dini risiko autisme pada balita.',
        'is_active' => true
    ],
    [
        'nama' => 'Kuesioner Masalah Perilaku Emosional (KMPE)',
        'singkatan' => 'KMPE',
        'domain' => 'sosial_emosional',
        'min_usia_bulan' => 36,
        'max_usia_bulan' => 72,
        'deskripsi' => 'Mendeteksi dini penyimpangan mental emosional pada anak prasekolah.',
        'is_active' => true
    ],
    [
        'nama' => 'GPPH (Gangguan Pemusatan Perhatian dan Hiperaktivitas - Abbreviated Conners)',
        'singkatan' => 'GPPH',
        'domain' => 'perilaku_adaptif',
        'min_usia_bulan' => 36,
        'max_usia_bulan' => null,
        'deskripsi' => 'Skala penilaian untuk mendeteksi gejala hiperaktivitas dan gangguan perhatian.',
        'is_active' => true
    ],
    [
        'nama' => 'SDQ (Strengths and Difficulties Questionnaire)',
        'singkatan' => 'SDQ',
        'domain' => 'sosial_emosional',
        'min_usia_bulan' => 48,
        'max_usia_bulan' => 204,
        'deskripsi' => 'Instrumen skrining perilaku singkat untuk anak usia 4-17 tahun.',
        'is_active' => true
    ],
    [
        'nama' => 'Pemeriksaan Daya Dengar (TDD)',
        'singkatan' => 'TDD',
        'domain' => 'bahasa',
        'min_usia_bulan' => 0,
        'max_usia_bulan' => 72,
        'deskripsi' => 'Skrining tajam pendengaran pada anak.',
        'is_active' => true
    ]
];

foreach ($tools as $tool) {
    AlatUkur::updateOrCreate(['singkatan' => $tool['singkatan']], $tool);
}

echo "Successfully seeded clinical tools master data.\n";
