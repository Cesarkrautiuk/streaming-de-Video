<?php

namespace App\Http\Controllers;

use App\Jobs\JobConverterVideo;

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

        JobConverterVideo::dispatch($video)->onQueue('converter');

        return response()->json([
            'message' => 'Upload recebido! Conversão em background iniciada.',
            'path'    => $video,
        ]);
    }
}
