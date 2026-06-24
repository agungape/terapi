<?php
$tarifs = \App\Models\Tarif::all();
foreach($tarifs as $t) {
    echo $t->id . ' - ' . $t->nama . ' - Jenis: ' . $t->jenis_terapi . ' - Max: ' . $t->jumlah_pertemuan . ' - Perilaku: ' . $t->pertemuan_perilaku . ' - Fisio: ' . $t->pertemuan_fisioterapi . "\n";
}
