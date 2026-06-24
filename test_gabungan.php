<?php
$pemasukkans = \App\Models\Pemasukkan::whereHas('tarif', function($q) {
    $q->where('jenis_terapi', 'gabungan');
})->get();

foreach($pemasukkans as $p) {
    $kunjungans = $p->kunjungans()->whereIn('status', ['hadir', 'izin_hangus'])->get();
    $count = $kunjungans->count();
    $max = $kunjungans->max('pertemuan');
    
    echo "ID: " . $p->id . ", Tarif ID: " . $p->tarif_id . "\n";
    echo " - Count: " . $count . "\n";
    echo " - Max Sesi: " . $max . "\n";
    if ($p->tarif) {
        echo " - Tarif Max: " . $p->tarif->jumlah_pertemuan . "\n";
        echo " - Max Perilaku: " . $p->tarif->pertemuan_perilaku . ", Fisio: " . $p->tarif->pertemuan_fisioterapi . "\n";
    }
}
