<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
// use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SAPLoginController extends Controller
{
    public function login(Request $request)
    {
        $options = [
            'json' => [
                "CompanyDB" => $request->CompanyDB,
                "UserName" => $request->UserName,
                "Password" => $request->Password
               ]
           ];

        $client = new Client([
            'verify'    => false,//SSL certificate
            'base_uri'  => 'https://172.20.0.11:50000/b1s/v1/',//BaseUri
            'cookies'   => true//Activo las Cookies
        ]);

        $response = $client->request('POST', "Login",  $options);
        return $response->getBody();
    }

    public function logout(Request $request)
    {
        $uri = "https://172.20.0.11:50000/b1s/v1/";

        // $jar = \GuzzleHttp\Cookie\CookieJar::fromArray(
        //     [
        //         'B1SESSION' => $request->B1SESSION,
        //     ],
        //     $uri
        // );

        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $jar->setCookie(
            new \GuzzleHttp\Cookie\SetCookie([
                    'Domain' =>  "https://172.20.0.11:50000/",
                    'Name'   =>  'B1SESSION',
                    'Value'  =>  $request->B1SESSION,
                    "Path"   =>  "/b1s/v1/Logout/"
                ])
        );

        $client = new Client([
            'verify'    => false,//SSL certificate
            'base_uri'  => $uri,//BaseUri
            'cookies'   => $jar,//Activo las Cookies
            'headers'   => [
                'Accept' => '*/*',
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept-Language' => 'en-US,en;q=0.8,hi;q=0.6,und;q=0.4'
            ]
        ]);

        // return dd($client);

        $response = $client->request('POST', "Logout");
        return $response;
    }

    public function MetaData(Request $request)
    {
        $client = new Client([
            'verify'    => false,//SSL certificate
            'base_uri'  => 'https://172.20.0.11:50000/b1s/v1/',//BaseUri
            'cookies'   => true//Activo las Cookies
        ]);

        $response = $client->request('GET', '$metadata');
        return $response->getBody();
    }

    public function metodoprueba(Request $data)
    {
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
