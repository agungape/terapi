<?php
$anak = \App\Models\Anak::find(23); // From the screenshot, anak_id is 23
if ($anak) {
    $pemasukkans = \App\Models\Pemasukkan::where('anak_id', $anak->id)
                ->where('jenis_layanan', 'paket_terapi')
                ->orderBy('tanggal', 'desc')
                ->get();
    
    echo 'Total Packages: ' . $pemasukkans->count() . "\n";
    foreach($pemasukkans as $p) {
        echo 'Pkg ' . $p->id . ' - Sisa: ';
        $sisa = $p->sisa_pertemuan;
        if(is_array($sisa)) echo 'Array'; else echo $sisa;
        echo "\n";
    }
}
