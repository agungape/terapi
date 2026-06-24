<?php
$pemasukkans = \App\Models\Pemasukkan::whereHas('tarif', function($q) {
    $q->where('jenis_terapi', 'gabungan')
      ->where(function($q2) {
          $q2->where('jumlah_pertemuan', 10)
             ->orWhere('pertemuan_perilaku', 10)
             ->orWhere('pertemuan_fisioterapi', 10);
      });
})->get();

foreach($pemasukkans as $p) {
    $kunjungans = $p->kunjungans()->whereIn('status', ['hadir', 'izin_hangus'])->get();
    $count = $kunjungans->count();
    $max = $kunjungans->max('pertemuan');
    
    if ($max >= 10 && $count <= 8) {
        echo "Pemasukkan ID: " . $p->id . ", Anak ID: " . $p->anak_id . "\n";
        echo "Count: " . $count . ", Max: " . $max . "\n";
        foreach($kunjungans as $k) {
            echo "- Sesi: " . $k->sesi . " Pertemuan: " . $k->pertemuan . " Status: " . $k->status . "\n";
        }
        echo "-------------------------\n";
    }
}
