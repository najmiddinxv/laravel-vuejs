<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Album $album)
    {
        //
    }

    public function edit(Album $album)
    {
        //
    }

    public function update(Request $request, Album $album)
    {
        //
    }

    public function destroy(Album $album)
    {
        //
    }

    // public function index()
    // {
    //     $meiliSearch = new Client('http://localhost:7700', 'API_KEY'); // Replace with your MeiliSearch server URL and API key

    //     $index = $meiliSearch->index('your_model_index');

    //     YourModel::chunk(200, function ($models) use ($index) {
    //         $documents = [];

    //         foreach ($models as $model) {
    //             $document = [
    //                 'id' => $model->id,
    //                 'image' => $model->image,
    //                 'title' => $model->translate('en')->title, // Adjust based on your actual translatable attributes
    //                 'second_title' => $model->translate('en')->second_title,
    //                 // ... other translatable attributes
    //             ];

    //             $documents[] = $document;
    //         }

    //         $index->addDocuments($documents);
    //     });

    //     return response()->json(['message' => 'Data indexed successfully']);
    // }

}
