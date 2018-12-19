<?php

namespace App;

use Illuminate\Support\Facades\File;
use Intervention\Image\Image;

class Document
{
    private $directory;

    public function __construct($directory = "docs")
    {
        $this->directory = $directory;
    }

    public function get($file = "index.md")
    {
        if (!File::exists($this->getPath($file))) {
            abort(404, 'File not exist');
        }

        File::get($this->getPath($file));
    }

    public function image($file)
    {
        return Image::make($this->getPath($file));
    }

    private function getPath($file)
    {
        $path = base_path($this->directory . DIRECTORY_SEPARATOR . $file);

        if (!File::exists($path)) {
            abort(404, 'File not exist');
        }

        return $path;
    }

    public function etag($file)
    {
        return md5($file . DIRECTORY_SEPARATOR . File::lastModified($this->getPath($file)));
    }
}
