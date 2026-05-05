<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$ps = App\Models\Pemasukkan::with('tarif')->where('jenis_layanan', 'paket_terapi')->get();
foreach($ps as $p) {
    if (!$p->tarif) continue;
    $sisa = $p->sisa_pertemuan;
    echo "ID: {$p->id} | Anak: {$p->anak_id} | Jenis: {$p->tarif->jenis_terapi} | Sisa: " . json_encode($sisa) . "\n";
}
