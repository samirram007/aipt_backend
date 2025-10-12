<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Storage;
use Str;

class FileController
{
    public function report_template_files(): ?JsonResponse
    {

        $path = 'reportTemplate';
        $files = Storage::disk('public')->files($path);

        $templates = collect($files)->map(fn($file) => basename($file));

        return response()->json(['data' => $templates]);
    }

}
