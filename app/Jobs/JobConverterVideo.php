<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use FFMpeg\Coordinate\Dimension;

class JobConverterVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $videoCaminho;

    public function __construct(string $videoCaminho)
    {
        $this->videoCaminho = $videoCaminho;
    }

    public function handle(): void
    {
        $disco = 'local';

        $videoCaminho = Storage::disk($disco)->path($this->videoCaminho);

        $caminhoVideoConvertido = 'convertido/video/' . basename($this->videoCaminho, '.mp4') . '_converted.mp4';


        $diretorioDestino = Storage::disk($disco)->path('convertido/video');

        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0777, true);
        }


        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => env('FFMPEG_BINARIES_PATH', 'C:\Users\cesar\Downloads\ffmpeg-master-latest-win64-gpl-shared\bin\ffmpeg.exe'),
            'ffprobe.binaries' => env('FFMPEG_BINARIES_PATH', 'C:\Users\cesar\Downloads\ffmpeg-master-latest-win64-gpl-shared\bin\ffprobe.exe'),
            'timeout' => 3600,
        ]);

        $video = $ffmpeg->open($videoCaminho);

        $formadoVideo = new X264('libmp3lame');

        $video->filters()->resize(new Dimension(1280, 720))->synchronize();

        $video->save($formadoVideo, Storage::disk($disco)->path($caminhoVideoConvertido));
        
        JobGerarMiniaturaCapa::dispatch($caminhoVideoConvertido)->onQueue('miniatura');
        Storage::disk($disco)->delete('uploads/' . basename($this->videoCaminho));

    }
}
