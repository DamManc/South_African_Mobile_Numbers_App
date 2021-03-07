<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(Request $request){
        $payload = json_decode($request->input('_ajpayload'), true);
        $response = [];
        if( is_array($payload) && !empty($payload)){
            if(preg_match('/^27[0-9]{9}$/', $payload['phone'])){
                $response['phone'] = $payload['phone'];
                $response['correct'] = 'This phone number is Correct!!';

            } else if(preg_match('/^27[0-9]{9}$/', preg_filter('/\D*/', '', $payload['phone']))){
                $revision = preg_filter('/\d*/', '', $payload['phone']);
                $phone = preg_filter('/\D*/', '', $payload['phone']);
                $response['phone'] = $phone;
                $response['revision'] = 'This phone number is Correct after delete: '. $revision;

            } else if(preg_match('/^27[0-9]{9}$/', preg_filter('/\D*[0-9]*$/', '', $payload['phone']))){
                $revision = preg_filter('/^27[0-9]{0,9}/', '', $payload['phone']);
                $phone = preg_filter('/\D*[0-9]*$/', '', $payload['phone']);
                $response['phone'] = $phone;
                $response['revision'] = 'This phone number is Correct after delete: '. $revision;

            } else if(preg_match('/^[0-9]{11}$/', $payload['phone'])){
                $error = "this phone number is not correct(not Country Code 27)";
                $response['error'] = $error;
            } else {
                $error = "this is not a phone number, even deleting the non-digits";
                $response['error'] = $error;
            }
            return $response;
        }

    }
}
