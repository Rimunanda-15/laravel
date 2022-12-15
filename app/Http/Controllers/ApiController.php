<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function memanggilAPI(){
        $token = "10|g6BUuUD7reJ2V9oQOj2IAvnOyUspXSlQPIDA9EQe";
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ])
        ->get('http://127.0.0.1:8080/api/getAllUserToo');

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }
}
