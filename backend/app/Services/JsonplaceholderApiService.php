<?php

namespace App\Services;

use App\DTO\JsonplaceholderPostDTO;
use Illuminate\Support\Facades\Http;

class JsonplaceholderApiService
{
    public function getPost(int $postId)
    {
        $response = Http::get(config('settings.jsonplaceholder_url')."/posts/{$postId}");
        return $response->json();
    }

    public function storePost(JsonplaceholderPostDTO $jsonplaceholderPostDTO)
    {
        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Content-type' => ' charset=UTF-8'
        ])->post(config('settings.jsonplaceholder_url').'/posts', [
            'userId' => 1,
            'title' => $jsonplaceholderPostDTO->title,
            'body' => $jsonplaceholderPostDTO->body,
        ]);

        return $response->json();

        // $response = Http::post(config('settings.jsonplaceholder_url').'/posts', $jsonplaceholderPostDTO->toArray());
        // $response = Http::withBasicAuth('taylor@laravel.com', 'secret')->post(/* ... */);
        // $response = Http::withToken('bearertoken')->post(/* ... */);
    }

    public function getComments(int $postId)
    {
        $response = Http::get(config('settings.jsonplaceholder_url')."/comments",[
            'postId' => $postId,
        ]);
        return $response->json();
        // return json_decode($response->getBody()->getContents(), true);
    }

}
