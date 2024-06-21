<?php

namespace App\Controllers;


use CodeIgniter\RESTful\ResourceController;
use vendor\GeminiAPI\Resources\Parts\TextPart;
use vendor\GeminiClient\GeminiClient;

class Test extends ResourceController
{
    protected $format    = 'json';

    public function index()
    {
        // $client = Gemini::client(getenv('GEMINI_API_KEY'));
        // $result = $client->geminiPro()->generateContent('Hello');
      
        // return $this->respond($result->text(), 200);
        $ch = curl_init();


        // Set the URL and other options
curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=".getenv('GEMINI_API_KEY'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// Set the POST data
$data = [
    "contents" => [
        [
            "parts" => [
                [
                    "text" => "create a bill  for 3  iphone with rate of $300. in json format"
                ]
            ]
        ]
    ]
];
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Execute the cURL session
$response = curl_exec($ch);

// Check for errors
if(curl_error($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Print the response
echo $response;
    }

    // ...
}