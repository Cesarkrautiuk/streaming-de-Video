<?php

use App\Http\Controllers\UploadVideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UploadVideoController::class, 'index'])->name('video.index');
Route::post('/upload-video', [UploadVideoController::class, 'upload'])->name('video.upload');

Route::get('/private-files/{filename}', function ($filename) {

    $path = storage_path('app/private/convertido/video/' . $filename);;

    // Verifique se o arquivo existe
    if (file_exists($path)) {
        return response()->file($path); // Envia o arquivo diretamente para o navegador
    }

    // Se o arquivo não for encontrado
    abort(404, 'Arquivo não encontrado.');
});

