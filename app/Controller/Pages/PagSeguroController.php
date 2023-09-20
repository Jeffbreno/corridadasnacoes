<?php

namespace App\Controller\Pages;

use GuzzleHttp\Client;

class PagSeguroController extends PageController
{
    public static function returnTransaction($request): void
    {
        $postVars = $request->getPostVars();
       print_r($postVars);
    }

    public static function newPedido(): void
    {
        $client = new Client();
        $requestData = [
            'customer' => [
                'name' => 'Jefferson Lopes',
                'email' => 'c13350933228387478964@sandbox.pagseguro.com.br',
                'tax_id' => '06262132406'
            ],
            'reference_id' => '0085',
            'items' => [
                [
                    'name' => 'Corrida das Nações',
                    'quantity' => 1,
                    'unit_amount' => 5000
                ]
            ],
            'charges' => [
                [
                    'amount' => [
                        'value' => 5000,
                        'currency' => 'BRL'
                    ],
                    'payment_method' => [
                        'card' => [
                            'exp_month' => 12,
                            'number' => '4111111111111111',
                            'exp_year' => 2030,
                            'security_code' => '123',
                            'store' => true
                        ],
                        'type' => 'CREDIT_CARD',
                        'installments' => 1,
                        'capture' => true,
                        'soft_descriptor' => 'Corrida'
                    ],
                    'reference_id' => '0085',
                    'description' => 'Corrida das Nações'
                ]
            ]
        ];

        $jsonData = json_encode($requestData);

        $response = $client->request('POST', 'https://sandbox.api.pagseguro.com/orders', [
            'body' => $jsonData,
            'headers' => [
                'Authorization' => 'Bearer 4CCB6F2B4CE640218816418F343CEE8E',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        echo $response->getBody();
        exit;
        $data = json_decode($response->getBody(), true);
        echo $data['id'];

    }
}
