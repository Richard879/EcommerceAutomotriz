<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SapNotaCreditoController extends Controller
{
    public function SapSetPedidoNotaCreditoDscto(Request $request)
    {
        $client = new Client([
            'base_uri'  => 'http://172.20.0.10/'
        ]);

        $nDocEntryPedido    = $request->nDocEntryPedido;
        $cItemCode          = $request->cItemCode;
        $dMontoNuevoSoles   = $request->dMontoNuevoSoles;

        $json = [
            'json' => [
                "CardCode"      => $value['cCardCode'],
                "DocumentLines" => [
                        [
                            "ItemCode"  => $cItemCode,
                            "Price"     => (string)$dMontoNuevoSoles,
                            "Quantity"  =>  1,
                            "TaxCode"   => "IGV"
                        ]
                    ]
                ]
            ];

        $response = $client->request('PATCH', "/api/Pedido/SapSetPedidoNotaCredito/($nDocEntryPedido)", $json);
        return $response->getBody();
    }
}
