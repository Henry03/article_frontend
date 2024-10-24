<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function submitLogin(AuthRequest $request){
        $client = new Client();
        try{
            $loginRequest = $client->post(config('api.api_link').'/login', [
                'verify' => false,
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
                'body' => json_encode([
                    "email" => $request->email,
                    "password" => $request->password
                ])
            ]);

            $data = json_decode($loginRequest->getbody());
            // dd($data);
            if($data->status){
                $request->session()->put('LoginSession', $data->token);
                $request->session()->put('IdUser', $data->user->user_id);
                $request->session()->put('LoginSessionName', $data->user->name);
                return redirect()->route('home')->with([
                    'status' => $data->status,
                    'message' => $data->message
                ]);
            }
        }catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents());
            dd($e);
            return redirect()->route('login')->with([
                'status' => $response->status,
                'message' => $response->message
            ]);
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('login');
    }
}
