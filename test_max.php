<?php
$max = \App\Models\Kunjungan::max(\Illuminate\Support\Facades\DB::raw('CAST(pertemuan AS UNSIGNED)'));
echo "Max casted: " . $max . "\n";
