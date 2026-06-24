<?php
$tarifs = \App\Models\Tarif::all();
foreach($tarifs as $t) {
    if ($t->jumlah_pertemuan == 10 || $t->pertemuan_perilaku == 10 || $t->pertemuan_fisioterapi == 10) {
        echo 'Found Tarif: ' . $t->id . ' - ' . $t->nama . "\n";
    }
}
$pemasukkans = \App\Models\Pemasukkan::with('tarif')->get();
foreach($pemasukkans as $p) {
    $count = $p->kunjungans()->whereIn('status', ['hadir', 'izin_hangus'])->count();
    $max = $p->kunjungans()->whereIn('status', ['hadir', 'izin_hangus'])->max('pertemuan');
    if ($count == 8 || $max == 8) {
        echo 'Found Pemasukkan: ' . $p->id . ' Tarif: ' . ($p->tarif->nama ?? 'Unknown') . ' Count: ' . $count . ' Max: ' . $max . "\n";
    }
}
