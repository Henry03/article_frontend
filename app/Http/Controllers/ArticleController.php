<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function store()
    {
        return view('storeArticle');
    }

    public function submitArticle(ArticleRequest $request)
    {
        $client = new Client();

        try{
            $loginRequest = $client->post(config('api.api_link').'/article/add', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
                ],
                'body' =>
                    json_encode([
                        'user_id' => $request->session()->get('IdUser'),
                        'title' => $request->title,
                        'description' => $request->description,
                        'body' => $request->body,
                        'action' => 'store'
                    ]),
                'verify' => false,
            ]);
    
            $data = json_decode($loginRequest->getbody());
            return redirect()->route('home')->with([
                'status' => $data->status,
                'message' => $data->message,
                'articles' => $data->data
            ]);
        }catch(RequestException $e){
            $response = json_decode($e->getResponse()->getBody()->getContents());
            dd($response);
            return back()->with([
                'status' => $response->status,
                'message' => $response->message
            ]);
        }
    }

    public function detailArticle(Request $request)
    {
        $id = $request->id;
        $client = new Client();
        
        $loginRequest = $client->get(config('api.api_link').'/article?article_id='.$id.'&user_id='.$request->session()->get('IdUser') , [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
            ],
            'verify' => false,
        ]);

        $data = json_decode($loginRequest->getbody());
        // dd($data);
        return view('detailArticle')->with([
            'status' => $data->status,
            'message' => $data->message,
            'article' => $data->data
        ]);
    }

    public function update(ArticleRequest $request){
        $id = $request->id;
        $client = new Client();
        
        $loginRequest = $client->get(config('api.api_link').'/article?article_id='.$id , [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
            ],
            'verify' => false,
        ]);

        $data = json_decode($loginRequest->getbody());
        // dd($data);
        return view('updateArticle')->with([
            'status' => $data->status,
            'message' => $data->message,
            'article' => $data->data
        ]);

    }

    public function submitUpdate(ArticleRequest $request){
        $id = $request->id;
        
        $client = new Client();

        try{
            $loginRequest = $client->post(config('api.api_link').'/article/add', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
                ],
                'body' =>
                    json_encode([
                        'user_id' => $request->session()->get('IdUser'),
                        'article_id' => $id,
                        'title' => $request->title,
                        'description' => $request->description,
                        'body' => $request->body,
                        'action' => 'update'
                    ]),
                'verify' => false,
            ]);
    
            $data = json_decode($loginRequest->getbody());
            return redirect()->route('home')->with([
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

    public function submitDelete(Request $request){
        $id = $request->id;
        
        $client = new Client();

        try{
            $loginRequest = $client->delete(config('api.api_link').'/article/delete', [
                'headers' => [
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer ' . $request->session()->get('LoginSession')
                ],
                'body' =>
                    json_encode([
                        'article_id' => $id,
                    ]),
                'verify' => false,
            ]);
    
            $data = json_decode($loginRequest->getbody());
            return redirect()->route('home')->with([
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
