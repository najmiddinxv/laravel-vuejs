<?php

namespace App\Services;

use App\Helpers\ImageResize;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    public function imageUpload($file, $basePath)
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

    public function imageDelete($image)
    {
        Storage::delete($image['large'] ?? '');
        Storage::delete($image['medium'] ?? '');
        Storage::delete($image['small'] ?? '');
    }


    public function fileUpload($file, $basePath)
    {
        $filePath = $basePath . '/' . now()->format('Y/m/d');
        if (!Storage::exists($filePath)) {
            Storage::makeDirectory($filePath, 0755, true, true);
        }

        $fileExt = $file->getClientOriginalExtension();

        $fileHashName = $filePath.'/'.md5(Str::random(10) . time()) . '.' . $fileExt;
        if($fileExt == 'jpg' || $fileExt == 'jpeg' || $fileExt == 'png' || $fileExt == 'gif'){
            $imageR = new ImageResize($file->getRealPath());
            $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($fileHashName));
            return $fileHashName;
        }else{
            $storedFile = Storage::putFileAs(
                $filePath,
                $file,
                $fileHashName
            );
            return $storedFile;
        }

    }

    public function fileDelete($file)
    {
        Storage::delete($file ?? '');
    }

}
