<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$request = Illuminate\Http\Request::create('/pemasukkan/layanan', 'GET', ['anak_id' => 70]);
$controller = new App\Http\Controllers\KeuanganController();
$response = $controller->getLayananByAnak($request);
echo json_encode($response, JSON_PRETTY_PRINT);
