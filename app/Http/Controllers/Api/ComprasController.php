<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComprasController extends Controller
{
    public function GetListComprasByIdAPI()
    {
        $client = new Client([
            'base_uri' => 'http://172.20.6.62/',// URI Ejem: https://jsonplaceholder.typicode.com
        ]);

        $response = $client->request('GET', "/Sap/api/Compra/GetListCompraByVin");

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }

    public function SetCliente()
    {
        $onRedirect = function(
            RequestInterface $request,
            ResponseInterface $response,
            UriInterface $uri
        ) {
            echo 'Redirecting! ' . $request->getUri() . ' to ' . $uri . "\n";
        };

        $client = new Client([
            'base_uri' => 'http://172.20.6.62/',// URI Ejem: https://jsonplaceholder.typicode.com
            'cookies' => true
        ]);

        $response = $client->request('POST', "/Sap/api/Compra/PostCliente",  [
            'allow_redirects' => [
                'max'             => 10,        // allow at most 10 redirects.
                'strict'          => true,      // use "strict" RFC compliant redirects.
                'referer'         => true,      // add a Referer header
                'protocols'       => ['https'], // only allow https URLs
                'on_redirect'     => $onRedirect,
                'track_redirects' => true
            ]
        ]);

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }

    public function login(Request $data)
    {
        // $data = [
        //     "CompanyDB" => 'SBO_INKA_PROD',
        //     "UserName" => 'janton',
        //     "Password" => '1234'
        // ];
        return $data;

        $client = new Client([
            'base_uri' => 'https://172.20.0.11:50000/b1s/v1/',//BaseUri
            'cookies' => true//Activo las Cookies
        ]);

        $response = $client->request('POST', "Login",  [
            'verify' => false,//Certificado False
            'json' => $data//Envio JSON
        ]);

        $posts = json_decode($response->getBody()->getContents());
        return $posts;
    }
}
