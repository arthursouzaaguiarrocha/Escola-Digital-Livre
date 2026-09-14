<?php

header('Content-Type: application/json; charset=utf-8');
// Uncomment if you need CORS:
// header('Access-Control-Allow-Origin: *');

$url = 'https://brasilapi.com.br/pix/v1/participants';

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 10,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER     => [
        'Accept: application/json',
        'User-Agent: MyApp/1.0'
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error    = curl_error($ch);
curl_close($ch);

if ($response === false || $httpCode !== 200) {
    http_response_code(500);
    echo json_encode([
        'error'   => 'Failed to fetch data from BrasilAPI',
        'details' => $error ?: "HTTP $httpCode"
    ]);
    exit;
}

echo $response;