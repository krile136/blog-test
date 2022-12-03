<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('admin.content.index');
    }

    public function show(int $content_id)
    {
        return view('admin.content.show');
    }
}
