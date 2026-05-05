<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$permissions = Spatie\Permission\Models\Permission::pluck('name')->toArray();
echo json_encode($permissions, JSON_PRETTY_PRINT);
