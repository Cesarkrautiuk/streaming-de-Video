<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobUploadVideo implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    protected UploadedFile $arquivo;
    public function __construct(UploadedFile $arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function handle(): void
    {
       $caminho = $this->arquivo->store('upload', 'local ');

       JobConverterVideo::dispatch($caminho)->onQueue('converter-video');
    }
}
