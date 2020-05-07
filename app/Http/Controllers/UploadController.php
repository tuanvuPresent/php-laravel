<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function index()
    {
        return collect(Storage::files('public/image/jpeg'))->map(function ($file) {
            return Storage::url($file);
        });
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $size = $file->getSize();
        $type = $file->getMimeType();

        Storage::putFileAs('public/' . $type, $file, $name);
        return response()->json([
            '$name' => $name,
            '$extension' => $extension,
            '$tempPath' => $tempPath,
            '$size' => $size,
            '$type' => $type,
        ]);
    }
}
