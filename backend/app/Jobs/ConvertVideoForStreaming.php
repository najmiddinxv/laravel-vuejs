<?php

namespace App\Jobs;

use App\DTOs\VideoData;
use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $id, private string $guid){}

    public function handle()
    {
        // $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        // $highBitrate = (new X264)->setKiloBitrate(1000);
        FFMpeg::fromDisk('public')
            ->open("video/{$this->id}/{$this->guid}")
            ->exportForHLS()
            // ->setSegmentLength(10) // optional
            // ->setKeyFrameInterval(48) // optional
            // ->addFormat($lowBitrate, function($media) {
            //     $media->addFilter('scale=640:480');
            // })
            // ->addFormat($midBitrate, function($media) {
            //     $media->scale(960, 720);
            // })
            // ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            // ->addFormat($highBitrate)
            // ->onProgress(function ($percentage, $remaining, $rate) {
            //     $this->info("{$remaining} seconds left at rate: {$rate}");
            // })
            // ->onProgress(function ($percentage) {
            //    $this->info("{$percentage}% transcoded");
            // })
            ->save("video/{$this->id}/".substr($this->guid, 0, -5).".m3u8");

        Storage::delete("video/{$this->id}/{$this->guid}");

        // ConvertVideoForStreaming::dispatch($model->id,$fileName);
    }
}
