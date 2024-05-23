<?php

namespace App\Services;

use App\DTO\JsonplaceholderPostDTO;
use Illuminate\Support\Facades\Http;

class JsonplaceholderApiService
{

    public function getComments(int $postId)
    {
        $response = Http::get(config('settings.jsonplaceholder_url')."/comments",[
            'postId' => $postId,
        ]);
        return $response->getBody()->getContents();
    }

    public function storePost(JsonplaceholderPostDTO $jsonplaceholderPostDTO)
    {
        // $response = Http::withHeaders([
        //     'X-First' => 'foo',
        //     'X-Second' => 'bar'
        // ])->post('http://example.com/users', [
        //     'name' => 'Taylor',
        // ]);
        // Basic authentication...
        // $response = Http::withBasicAuth('taylor@laravel.com', 'secret')->post(/* ... */);
        // $response = Http::withToken('bearertoken')->post(/* ... */);


        $response = Http::post(config('settings.jsonplaceholder_url').'/posts', $jsonplaceholderPostDTO);

        return $response;
    }
}
