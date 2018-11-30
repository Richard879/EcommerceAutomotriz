<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
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
        // Convierte un Objeto de PHP en JSON
        // $data = json_encode($data);

        $options = [
            'json' => [
                "CompanyDB" => "SBO_INKA_PROD",
                "UserName" => "janton",
                "Password" => "1234"
               ]
           ];

        $client = new Client([
            // 'curl'      => array(
            //                 CURLOPT_SSL_VERIFYPEER => false,
            //                 CURLOPT_SSL_VERIFYHOST => false
            //                 ),
            'verify'    => false,//SSL certificate
            'base_uri'  => 'https://172.20.0.11:50000/b1s/v1/',//BaseUri
            'cookies'   => true//Activo las Cookies
            // 'headers'   => [
            //     'Accept' => 'application/json',
            //     'Content-Type' => 'application/json'
            // ],
        ]);

        // $response = $client->request('POST', "Login",  [
        //     'headers'   => ['Content-Type' => 'application/json'],
        //     'body'      => json_encode([
        //                         $data
        //                     ])
        //     // 'body' => $data
        // ]);

        $response = $client->post("Login", $options);

        return $response->getBody();
        // $posts = json_decode($response->getBody()->getContents());
        // return $posts;
    }
}
