<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $client = new Client();
        
        $response = $client->get(config('api.api_link').'/article?user_id='.$request->session()->get('IdUser'), [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
            'verify' => false,
        ]);

        $data = json_decode($response->getbody());
        return view('home')->with([
            'status' => $data->status,
            'message' => $data->message,
            'articles' => $data->data
        ]);
    
    }

    public function indexById(Request $request) {
        $client = new Client();
        
        $loginRequest = $client->get(config('api.api_link').'/article/my', [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
            ],
            'verify' => false,
        ]);

        $data = json_decode($loginRequest->getbody());
        return view('homeMyPost')->with([
            'status' => $data->status,
            'message' => $data->message,
            'articles' => $data->data
        ]);
    
    }
}
