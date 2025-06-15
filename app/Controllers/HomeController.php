<?php

namespace App\Controllers;

use App\Models\PostModel;


class HomeController extends BaseController
{
    public function index()
    {
        helper('text');
        $postModel = new PostModel();

        $data = [
            'title' => 'Selamat Datang di BNN News',
            'posts' => $postModel->select('posts.*, categories.name as category_name')
                                ->join('categories', 'categories.id = posts.category_id')
                                ->where('status', 'published')
                                ->orderBy('posts.created_at', 'DESC')
                                ->paginate(6),
            'pager' => $postModel->pager,
        ];

        return view('home/index', $data);
    }
}
