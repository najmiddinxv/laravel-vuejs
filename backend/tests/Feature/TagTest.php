<?php

namespace Tests\Feature;

use App\Models\Content\Tag;
use Database\Factories\TagFactory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TagTest extends TestCase
{
    use WithoutMiddleware;


    public function test_show_create():void
    {
        $data = [
            'tagsable_type'=> 'App\Models\Content\News',
            'name'=> [
                'uz' => 'Universitet',
                'ru' => 'Университет',
                'en' => 'University',
            ],
        ];
        $response = $this->post(route('api.tags.store',$data));
        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', ['name->uz' => 'Universitet']); // Check specific JSON key
    }


    public function test_tag_list(): void
    {
        $response = $this->get(route('api.tags.index'));
        $response->assertStatus(200);
    }


    public function test_show_tag():void
    {
        $tag = Tag::latest()->first();
        $response = $this->get(route('api.tags.show',['tag' => $tag->id]));
        $response->assertStatus(200);
    }

    public function test_update_tag():void
    {
        $tag = Tag::latest()->first();

        $updateData = [
            'tagsable_type' => 'App\Models\Content\News',
            'name' => [
                'uz' => 'Oliy taʼlim',
                'ru' => 'Высшее образование',
                'en' => 'Higher Education',
            ],
        ];

        $response = $this->put(route('api.tags.update', $tag->id), $updateData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tags', ['id' => $tag->id, 'name->uz' => 'Oliy taʼlim']);
    }

    public function test_delete_tag()
    {
        $tag = Tag::latest()->first();
        $response = $this->delete(route('api.tags.destroy',['tag'=>$tag->id]));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
