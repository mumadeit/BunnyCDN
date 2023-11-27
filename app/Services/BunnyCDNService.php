<?php

// All rights reserved.
// Made by:  Muayid Ahmed, Mu Made It.

/**
 * 
 * use App/Services/BunnyCDNService.php;
 */

namespace App\Services;

use GuzzleHttp\Client;

class BunnyCDNService
{
    protected $client;

    // Constructor to initialize the Client.
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('BUNNYCDN_REGION'),
            'headers' => [
                'AccessKey' => env('BUNNYCDN_API_KEY'),
                'Content-Type' => 'application/octet-stream'
            ],
        ]);
    }
    // Upload Image to BunnyCDN Storage Zone.
    public function uploadImage($filePath, $fileName)
    {
        $response = $this->client->request('PUT', env('BUNNYCDN_STORAGE_ZONE_NAME') . '/' . $fileName, [
            'body' => fopen($filePath, 'r'),
            'headers' => ['Content-Length' => filesize($filePath)]
        ]);

        return $response;
    }
}
