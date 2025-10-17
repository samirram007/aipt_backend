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

    public function downloadTemplate(string $filename)
    {
        $filePath = 'reportTemplate/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $fullPath = Storage::disk('public')->path($filePath);

        return response()->download(
            $fullPath,
            $filename,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']
        );
    }
}
