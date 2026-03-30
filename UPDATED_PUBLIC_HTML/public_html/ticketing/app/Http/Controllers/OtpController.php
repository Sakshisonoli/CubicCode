<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showOtpLoginForm(){

        return view('backend.auth.otp_login');
    }

    public function verifyMsg91JWT(Request $request){

        $request->validate([
            'token' => 'required|string',
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://control.msg91.com/api/v5/widget/verifyAccessToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'authkey' => '444743TU4B2wAExI6831cddcP1',
                'access-token' => $request->token,
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseData = json_decode($response, true);

        if (!empty($responseData['status']) && $responseData['status'] === 'success') {
            $mobile = $responseData['data']['mobile'];

            $user = \App\Models\User::where('phone', $mobile)->first();

            if ($user) {
                \Auth::login($user);
                return response()->json(['status' => 'success', 'redirect_url' => route('customer_dashboard')]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'User not found.']);
            }
        }

        return response()->json(['status' => 'error', 'message' => 'Token verification failed.']);
    }

}
