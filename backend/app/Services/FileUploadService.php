<?php

namespace App\Services;

use App\Helpers\ImageResize;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{
    //rasm kesib uch xil o'lchamda katta,o'rtacha,kichik qilib yuklash uchun
    public function resizeImageUpload($file, $basePath)
    {
        // $imagePath = $basePath . '/' . now()->format('Y/m/d');
        $imagePath = $basePath;
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

    //kesib uch xil o'lchamda katta,o'rtacha,kichik qilib yuklangan rasmni o'chirish uchun
    public function resizedImageDelete($image)
    {
        Storage::delete($image['large'] ?? '');
        Storage::delete($image['medium'] ?? '');
        Storage::delete($image['small'] ?? '');
    }

    //rasmni razmerini o'zgartirmasdan faqat hajmini(mb) o'zgartirib yuklash uchun
    //rasmni kesib faqat katta hajmda yuklaydi, Bunda rasmni hajmi(mb) qisqaradi ammo o'lchami qisqarmaydi
    public function resizeImageOnlyLargeUpload($image, $basePath)
    {
        // $imagePath = $basePath . '/' . now()->format('Y/m/d');
        $imagePath = $basePath;

        if (!Storage::exists($imagePath)) {
            Storage::makeDirectory($imagePath, 0755, true, true);
        }

        $fileExt = $image->getClientOriginalExtension();

        $imageHashName = md5(Str::random(10) . time()) . '.' . $fileExt;
        $imagePathAndHashName = $imagePath.'/'.$imageHashName;

        $imageR = new ImageResize($image->getRealPath());
        $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($imagePathAndHashName));
        $filesize = Storage::size($imagePathAndHashName);

        return [$imagePathAndHashName, $filesize];
    }

    public function resizedImageOnlyLargeDelete($image)
    {
        Storage::delete($image ?? '');
        // Storage::delete($image['large'] ?? '');
    }

    //rasmni original holati bo'yicha hajmi necha mb bo'lsa ham yuklash uchun
    public function originalImageUpload($image, $basePath)
    {
        // $imagePath = $basePath . '/' . now()->format('Y/m/d');
        $imagePath = $basePath;
        if (!Storage::exists($imagePath)) {
            Storage::makeDirectory($imagePath, 0755, true, true);
        }

        $imageHashName = md5(Str::random(10) . time()) . '.' . $image->getClientOriginalExtension();
        $storedImagepath = $image->storeAs($imagePath, $imageHashName);
        $filesize = Storage::size($storedImagepath);

        return [$storedImagepath, $filesize];
    }
    public function originalImageDelete($image)
    {
        Storage::delete($image ?? '');
    }

    //fayl yuklash uchun
    public function fileUpload($file, $basePath)
    {
        // $filePath = $basePath . '/' . now()->format('Y/m/d');
        $filePath = $basePath;

        if (!Storage::exists($filePath)) {
            Storage::makeDirectory($filePath, 0755, true, true);
        }

        $fileHashName = md5(Str::random(10) . time()) . '.' . $file->getClientOriginalExtension();
        $filePathAndHashName = $filePath.'/'.$fileHashName;

        $storedFile = '/'.Storage::putFileAs($filePath, $file, $fileHashName);
        $filesize = Storage::size($filePathAndHashName);

        return [$storedFile, $filesize];
    }

    //yuklangan faylni o'chirish uchun
    public function fileDelete($file)
    {
        Storage::delete($file ?? '');
    }

    //rasm kesib uch xil o'lchamda katta,o'rtacha,kichik qilib yuklash uchun yoki fayl yuklash uchun
    //ram yoki fayl yuklash uchun
    public function fileAndImageUpload($file, $basePath)
    {
        // $filePath = $basePath . '/' . now()->format('Y/m/d');
        $filePath = $basePath;
        if (!Storage::exists($filePath)) {
            Storage::makeDirectory($filePath, 0755, true, true);
        }

        $fileExt = $file->getClientOriginalExtension();

        $fileHashName = md5(Str::random(10) . time()) . '.' . $fileExt;
        $fileAndHashName = $filePath.'/'.$fileHashName;

        if($fileExt == 'jpg' || $fileExt == 'jpeg' || $fileExt == 'png' || $fileExt == 'gif'){
            $imageR = new ImageResize($file->getRealPath());
            $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($fileAndHashName));
            $filesize = Storage::size($fileAndHashName);
            // $fileSize = File::size(public_path('images/1461177230.jpg'));

            return [$fileAndHashName, $filesize];
        }else{
            $storedFile = '/'.Storage::putFileAs($filePath, $file, $fileHashName);
            // $storedFile = Storage::put($filePath,$fileHashName);
            $filesize = Storage::size($fileAndHashName);

            return [$storedFile, $filesize];
        }
    }

    //yuklangan ram yoki faylni o'chirish uchun
    public function fileAndImageDelete($file)
    {
        Storage::delete($file ?? '');
    }

    // https://laravel.com/docs/11.x/filesystem
    // $path = $request->file('avatar')->storeAs(
    //     'avatars', $request->user()->id
    // );
    // $path = Storage::putFileAs(
    //     'avatars', $request->file('avatar'), $request->user()->id
    // );
    // $path = Storage::putFile('avatars', $request->file('avatar'));
    // Storage::put('avatars/1', $content);
    // $imageName = time().'.'.$request->image->extension();
    // // Public Folder
    // $request->image->move(public_path('images'), $imageName);
    // //Store in Storage Folder
    // $request->image->storeAs('images', $imageName);
    // // Store in S3
    // $request->image->storeAs('images', $imageName, 's3');

}
