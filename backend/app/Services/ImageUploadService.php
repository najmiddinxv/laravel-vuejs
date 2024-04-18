<?php

namespace App\Services;

use App\Helpers\ImageResize;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function upload($file, $basePath)
    {
        $imagePath = $basePath . '/' . now()->format('Y/m/d');
        if (!Storage::exists($imagePath)) {
            Storage::makeDirectory($imagePath, 0755, true, true);
        }

        $imageHashName = md5(Str::random(10) . time()) . '.' . $file->getClientOriginalExtension();
        $imageLargeHashName = $imagePath . '/l_' . $imageHashName;
        $imageMediumHashName = $imagePath . '/m_' . $imageHashName;
        $imageSmallHashName = $imagePath . '/s_' . $imageHashName;

        $imageR = new ImageResize($file->getRealPath());
        $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($imageLargeHashName));
        $imageR->resizeToBestFit(500, 500)->save(Storage::path($imageMediumHashName));
        $imageR->resizeToBestFit(150, 150)->save(Storage::path($imageSmallHashName));

        return [
            'large' => $imageLargeHashName,
            'medium' => $imageMediumHashName,
            'small' => $imageSmallHashName,
        ];
    }

    public function delete($image)
    {
        Storage::delete($image['large'] ?? '');
        Storage::delete($image['medium'] ?? '');
        Storage::delete($image['small'] ?? '');
    }
}
