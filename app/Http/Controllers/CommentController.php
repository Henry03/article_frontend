<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request){
        $client = new Client();
        
        try{
            $loginRequest = $client->post(config('api.api_link').'/comment/add', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
                ],
                'body' =>
                    json_encode([
                        'user_id' => $request->session()->get('IdUser'),
                        'article_id' => $request->article_id,
                        'body' => $request->comment,
                    ]),
                'verify' => false,
            ]);
    
            $data = json_decode($loginRequest->getbody());
            return back()->with([
                'status' => $data->status,
                'message' => $data->message,
                'articles' => $data->data
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
