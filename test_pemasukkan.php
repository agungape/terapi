<?php
$p = \App\Models\Pemasukkan::find(245);
if ($p) {
    echo "Tarif Max: " . ($p->tarif->jumlah_pertemuan ?? 'null') . "\n";
    echo "Tarif Perilaku: " . ($p->tarif->pertemuan_perilaku ?? 'null') . "\n";
    echo "Tarif Fisio: " . ($p->tarif->pertemuan_fisioterapi ?? 'null') . "\n";
    echo "Sudah Terpakai: " . $p->sudah_terpakai . "\n";
} else {
    echo "Pemasukkan 245 not found\n";
}
