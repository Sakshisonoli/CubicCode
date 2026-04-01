<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PhonePeService
{
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        // $this->clientId = 'TEST-M22NA18SIZUSW_25041';
        // $this->clientSecret = 'NzgwM2QzN2ItZDRiZC00NDFkLWJlOWItOWVmYmFjNjVlOGZm';
        $this->clientId = 'SU2504101019012437761314';
        $this->clientSecret = '694ca41c-e16a-4df0-ba65-46950489b0bb';
    }


    public function getAccessToken()
    {
        $response = Http::asForm()->post('https://api.phonepe.com/apis/identity-manager/v1/oauth/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'client_version' => 1,
            'grant_type' => 'client_credentials',
        ]);
        //need to change with production url

        // Log the response to see what PhonePe returns
        \Log::info('PhonePe OAuth Response', [
            'status' => $response->status(),
            'body' => $response->body(),
            'json' => $response->json(),
        ]);

        $data = $response->json();
        // dd($data);
        if (!isset($data['access_token'])) {
            throw new \Exception('Unable to get access token from PhonePe');
        }

        return $data['access_token'];
    }


    public function generatePaymentRequest($orderId, $amount, $redirectUrl)
    {
        $token = $this->getAccessToken();

        $payload = [
            'merchantOrderId' => $orderId,
            'amount' => $amount * 100, // in paise
            'expireAfter' => 1200,
            'paymentFlow' => [
                'type' => 'PG_CHECKOUT',
                'message' => 'Complete your payment',
                'merchantUrls' => [
                    'redirectUrl' => $redirectUrl,
                ],
            ],
        ];


        $response = Http::withHeaders([
            'Authorization' => 'O-Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post('https://api.phonepe.com/apis/pg/checkout/v2/pay', $payload);


        $res = $response->json();
        if (!isset($res['redirectUrl'])) {
            throw new \Exception('Invalid response from PhonePe: ' . ($res['message'] ?? 'Unknown error'));
        }

        return $res['redirectUrl'];
    }

    public function checkPaymentStatus($transactionId)
    {
        $token = $this->getAccessToken();

        $merchantId = urlencode($this->clientId);
        $transactionId = urlencode($transactionId);

        $url = "https://api.phonepe.com/apis/pg/checkout/v2/order/$transactionId/status";

        $response = Http::withHeaders([
            'Authorization' => 'O-Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->get($url);

        \Log::info('PhonePe Hermes Payment Status Response', [
            'url' => $url,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch payment status from PhonePe Hermes: ' . $response->body());
    }

    // public function __construct()
    // {
    //     $this->clientId = 'TEST-M22NA18SIZUSW_25041';
    //     $this->clientSecret = 'NzgwM2QzN2ItZDRiZC00NDFkLWJlOWItOWVmYmFjNjVlOGZm';
    //     // $this->clientId = 'SU2504101019012437761314';
    //     // $this->clientSecret = '694ca41c-e16a-4df0-ba65-46950489b0bb';
    // }

    // // https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token - Test URL
    // // https://api.phonepe.com/apis/hermes/v1/oauth/token - Live URL


    // public function getAccessToken()
    // {
    //     return Cache::remember('phonepe_access_token', 3500, function () {
    //         $response = Http::asForm()->post('https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token', [
    //             'client_id' => $this->clientId,
    //             'client_secret' => $this->clientSecret,
    //             'client_version' => 1,
    //             'grant_type' => 'client_credentials',
    //         ]);
    //         //need to change with production url

    //         // Log the response to see what PhonePe returns
    //         \Log::info('PhonePe OAuth Response', [
    //             'status' => $response->status(),
    //             'body' => $response->body(),
    //             'json' => $response->json(),
    //         ]);

    //         $data = $response->json();
    //         // dd($data);
    //         if (!isset($data['access_token'])) {
    //             throw new \Exception('Unable to get access token from PhonePe');
    //         }

    //         return $data['access_token'];
    //     });
    // }


    // public function generatePaymentRequest($orderId, $amount, $redirectUrl)
    // {
    //     $token = $this->getAccessToken();

    //     $payload = [
    //         'merchantOrderId' => $orderId,
    //         'amount' => $amount * 100, // in paise
    //         'expireAfter' => 1200,
    //         'paymentFlow' => [
    //             'type' => 'PG_CHECKOUT',
    //             'message' => 'Complete your payment',
    //             'merchantUrls' => [
    //                 'redirectUrl' => $redirectUrl,
    //             ],
    //         ],
    //     ];

    //     // https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay - Test URL
    //     // https://api.phonepe.com/apis/hermes/pg/v2/pay

    //     $response = Http::withHeaders([
    //         'Authorization' => 'O-Bearer ' . $token,
    //         'Content-Type' => 'application/json',
    //     ])->post('https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay', $payload);
    //         //need to change with production url

    //     $res = $response->json();
    //     if (!isset($res['redirectUrl'])) {
    //         throw new \Exception('Invalid response from PhonePe: ' . ($res['message'] ?? 'Unknown error'));
    //     }

    //     return $res['redirectUrl'];
    // }
}
