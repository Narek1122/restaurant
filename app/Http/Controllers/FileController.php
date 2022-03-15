<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function getFile(Request $request){
        $path = $request['path'] ?? 'public/null_img.png';

        return response()->file(Storage::path($path));
    }
}
