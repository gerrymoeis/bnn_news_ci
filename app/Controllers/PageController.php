<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PageController extends BaseController
{
    public function about()
    {
        return view('pages/about', ['title' => 'Tentang Kami']);
    }

    public function contact()
    {
        return view('pages/contact', ['title' => 'Kontak']);
    }
}
