<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function submitStore(Request $request)
    {
        $id = $request->id;
        $client = new Client();

        try{
            $loginRequest = $client->post(config('api.api_link').'/like/add', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
                ],
                'body' =>
                    json_encode([
                        'user_id' => $request->session()->get('IdUser'),
                        'article_id' => $id,
                    ]),
                'verify' => false,
            ]);
    
            $data = json_decode($loginRequest->getbody());
            return back()->with([
                'status' => $data->status,
                'message' => $data->message
            ]);
        }catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents());
            return back()->with([
                'status' => $response->status,
                'message' => $response->message
            ]);
        }
    }
}
