<?php

namespace App\Http\Controllers;

use App\Jobs\JobConverterVideo;

use App\Models\Video;
use Illuminate\Http\Request;

class UploadVideoController extends Controller
{
    public function index()
    {
        return view('uploadVideo');
    }

    public function upload(Request $request)
    {
        $video = $request->file('video')->store('uploads', 'local');

        $nomeVideo = basename($video, '.mp4');

        $request->input('titulo');

        $request->input('descricao');

        JobConverterVideo::dispatch($video)->onQueue('converter');

        Video::create([
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
            'video' => $nomeVideo . '_converted.mp4',
            'capa' => $nomeVideo . '_converted-thumbnail.jpg',
        ]);

        return response()->json([
            'message' => 'Upload recebido! Conversão em background iniciada.',
            'path' => $nomeVideo,
        ]);
    }
}
