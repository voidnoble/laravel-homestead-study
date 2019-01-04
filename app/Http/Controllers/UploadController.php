<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function form()
    {
        return view('upload');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
                'upfile' => 'mimes:jpeg,png,gif |max:10240'
            ],
            $messages = [
                'required' => 'The :attribute field is required.',
                'mimes' => 'Only jpg, png, bmp, gif are allowed.'
            ]
        );

        if ($request->hasFile('upfile')) {
//            Storage::disk('s3')->put($request->file('upfile')->getFilename(), fopen($request->file('upfile')->getClientOriginalName(), 'r+'), 'public');
            $request->file('upfile')->store('images', 's3');

            $url = Storage::disk('s3')->url($request->file('upfile')->getFilename());
        }

        return $url;
    }
}
