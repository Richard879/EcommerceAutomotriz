<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComprasController extends Controller
{
    public function GetListComprasByIdAPI(){
        $client = new Client([
            'base_uri' => 'http://172.20.6.62/',// URI Ejem: https://jsonplaceholder.typicode.com
        ]);

        $response = $client->request('GET', "/Sap/api/Compra/GetListCompraByVin");

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }
}
