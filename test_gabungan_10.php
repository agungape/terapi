<?php
$tarifs = \App\Models\Tarif::where('jumlah_pertemuan', 10)
    ->orWhere('pertemuan_perilaku', 10)
    ->orWhere('pertemuan_fisioterapi', 10)
    ->get();
foreach($tarifs as $t) {
    echo "Tarif: " . $t->id . " - " . $t->nama . " - Max: " . $t->jumlah_pertemuan . "\n";
}

$pemasukkans = \App\Models\Pemasukkan::with('tarif')->whereHas('tarif', function($q){
    $q->where('jumlah_pertemuan', 10)
      ->orWhere('pertemuan_perilaku', 10)
      ->orWhere('pertemuan_fisioterapi', 10);
})->get();
foreach($pemasukkans as $p) {
    echo "Pemasukkan: " . $p->id . " Anak: " . $p->anak_id . " Tarif: " . $p->tarif->nama . "\n";
}
