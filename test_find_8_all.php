<?php
$pemasukkans = \App\Models\Pemasukkan::with('tarif')->get();
foreach($pemasukkans as $p) {
    $count = $p->kunjungans()->whereIn('status', ['hadir', 'izin_hangus'])->count();
    $max = $p->kunjungans()->whereIn('status', ['hadir', 'izin_hangus'])->max('pertemuan');
    if ($count == 8 || $max == 8 || $count == 10 || $max == 10) {
        echo 'Pemasukkan: ' . $p->id . ' Anak: ' . $p->anak_id . ' Tarif: ' . ($p->tarif->nama ?? 'Unknown') . ' Count: ' . $count . ' Max: ' . $max . "\n";
    }
}
