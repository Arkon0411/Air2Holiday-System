<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/functions.php';

$country = trim($_GET['country'] ?? '');
if ($country === '') {
    echo json_encode(['success' => false, 'error' => 'country required', 'data' => []]);
    exit;
}

// Try to fetch flights. If none found, return empty array.
$flights = getFlightsByCountry($country, 50);

echo json_encode(['success' => true, 'data' => $flights]);
