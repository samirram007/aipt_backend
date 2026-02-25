<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class SsrController extends Controller
{
    public function __invoke()
    {
        $url = '/' . request()->path();

        // Run compiled SSR bundle with Node
        $output = Process::run("node bootstrap/ssr/entry-server.js \"$url\"");

        $appHtml = $output->output();
        $template = File::get(public_path('index.html'));

        return response(
            str_replace('<!--app-->', $appHtml, $template)
        );
    }
}
