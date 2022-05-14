<?php
require_once 'linkedin-api-config.php';
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;

$linkedin_id = $_REQUEST["id"];
$body = new \stdClass();
$body->text = new \stdClass();
$body->owner = 'urn:li:person:' . $linkedin_id;
$body->text->text = $_REQUEST["text"];
$body_json = json_encode($body, true);

try {
    $client = new Client(['base_uri' => 'https://api.linkedin.com']);
    $response = $client->request('POST', '/v2/shares', [
        'headers' => [
            "Authorization" => "Bearer " . $_REQUEST["token"],
            "Content-Type"  => "application/json",
            "x-li-format"   => "json"
        ],
        'body' => $body_json,
    ]);
} catch (Exception $e) {
    //echo $e->getMessage() . ' for link ' . $link;
}

header('Location: index.php?action=linkdone');
