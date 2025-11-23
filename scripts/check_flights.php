<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$rows = DB::table('flights')
    ->where('status', 'Scheduled')
    ->where('scheduled_departure', '>', date('Y-m-d H:i:s'))
    ->orderBy('scheduled_departure')
    ->get();

echo json_encode($rows, JSON_PRETTY_PRINT);
