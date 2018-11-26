<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComprasController extends Controller
{
    public function GetListComprasByIdAPI($id){
        $client = new Client([
            // Base URI se utiliza con solicitudes relativas
            'base_uri' => 'http:/172.20.6.62:53218/SrvCompra.svc?WSDL',// URI Ejem: https://jsonplaceholder.typicode.com
        ]);

        // Enviar una solicitud del verbo GET a http://192.168.114.1:53218/SrvCompra.svc/List_GetListCompraByVin?id=MALC281CAJM305579
        $response = $client->request('GET', "/List_GetListCompraByVin/{$id}");

        return $response;
        // Solo si la rpta es JSON se debe ingresar al contenido del cuerpo y decodificar
        // $posts = json_decode($response->getBody()->getContents());
        // return $posts;
    }

    public function getPost(){
        $client = new Client([
            // Base URI se utiliza con solicitudes relativas
            'base_uri' => 'https://jsonplaceholder.typicode.com',
        ]);

        // Enviar una solicitud del verbo GET a
        $response = $client->request('GET', "/posts");

        // Solo si la rpta es JSON se debe ingresar al contenido del cuerpo y decodificar
        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }
}
