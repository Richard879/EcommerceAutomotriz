<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComprasController extends Controller
{
    public function GetListCompraByVin()
    {
        $client = new Client([
            // Base URI se utiliza con solicitudes relativas
            'base_uri' => 'http://192.168.114.1:53218/SrvCompra.svc?WSDL',
        ]);

        $response = $client->request('GET', "/List_GetListCompraByVin");

        return $response;
    }

    /*
        // public function GetListCompraByVin($id){
        //     $client = new Client([
        //         // Base URI se utiliza con solicitudes relativas
        //         'base_uri' => 'http:/172.20.6.62:53218/SrvCompra.svc?WSDL/',// URI Ejem: https://jsonplaceholder.typicode.com
        //     ]);

        //     // Enviar una solicitud del verbo GET a http://192.168.114.1:53218/SrvCompra.svc/List_GetListCompraByVin?id=MALC281CAJM305579
        //     $response = $client->request('GET', "/List_GetListCompraByVin/{$id}");

        //     return $response;
        //     // Solo si la rpta es JSON se debe ingresar al contenido del cuerpo y decodificar
        //     // $posts = json_decode($response->getBody()->getContents());
        //     // return $posts;
        // }
    */

    public function GetPosts($id)
    {
        $client = new Client([
            // Base URI se utiliza con solicitudes relativas
            'base_uri' => 'https://jsonplaceholder.typicode.com',
        ]);

        // Enviar una solicitud del verbo GET a https://jsonplaceholder.typicode.com/posts/1
        $response = $client->request('GET', "posts/{$id}");

        // Solo si la rpta es JSON se debe ingresar al contenido del cuerpo y decodificar
        // $posts = json_decode($response->getBody()->getContents());
        $posts = ($response->getBody()->getContents());
        return $posts;
        //dd($posts);
    }
}
