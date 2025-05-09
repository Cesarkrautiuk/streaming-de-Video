<?php

namespace App\Jobs;

use FFMpeg\Coordinate\TimeCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
class JobGerarMiniaturaCapa implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected string $videoCaminho;

    public function __construct(string $videoCaminho)
    {
        $this->videoCaminho = $videoCaminho;
    }

    public function handle(): void
     {
         $disco = 'local';

         $videoCaminho = Storage::disk($disco)->path($this->videoCaminho);

         $caminhoMiniatura = 'thumbnails/' . basename($this->videoCaminho, '.mp4') . '-thumbnail.jpg';

         $ffmpeg = \FFMpeg\FFMpeg::create([
             'ffmpeg.binaries' => 'C:\Users\cesar\Downloads\ffmpeg-master-latest-win64-gpl-shared\bin\ffmpeg.exe',
             'ffprobe.binaries' => 'C:\Users\cesar\Downloads\ffmpeg-master-latest-win64-gpl-shared\bin\ffprobe.exe',
             'timeout' => 3600,
         ]);

         $video = $ffmpeg->open($videoCaminho);

         $video->frame(TimeCode::fromSeconds(2))
         ->save(Storage::disk($disco)->path($caminhoMiniatura));


     }
}
