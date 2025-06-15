<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new PostModel();
        $data = [
            'title' => 'Kelola Postingan',
            'posts' => $postModel->where('user_id', session()->get('id'))
                                ->orderBy('created_at', 'DESC')
                                ->findAll()
        ];
        return view('posts/index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Tambah Postingan Baru',
            'categories' => $categoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('posts/form', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[5]',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'uploaded[thumbnail]|max_size[thumbnail,1024]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $postModel = new PostModel();
        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        // Ensure slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while ($postModel->isSlugTaken($slug)) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $thumbnailFile = $this->request->getFile('thumbnail');
        $thumbnailName = $thumbnailFile->getRandomName();
        $thumbnailFile->move('uploads/thumbnails', $thumbnailName);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id'),
            'user_id' => session()->get('id'),
            'thumbnail' => $thumbnailName,
            'status' => 'pending' // Default status
        ];

        $postModel->save($data);

        return redirect()->to('/posts')->with('message', 'Postingan berhasil dibuat dan sedang menunggu persetujuan.');
    }


    public function show($slug)
    {
        $postModel = new PostModel();
        $post = $postModel->getPostBySlugWithCategory($slug);

        if (!$post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Postingan tidak ditemukan: ' . $slug);
        }

        $data = [
            'title' => $post['title'],
            'post' => $post
        ];

        return view('posts/show', $data);
    }


    public function edit($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        // Authorization check
        if (empty($post) || $post['user_id'] != session()->get('id')) {
             return redirect()->to('/posts')->with('error', 'Anda tidak diizinkan untuk mengedit postingan ini.');
        }

        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Edit Postingan',
            'post' => $post,
            'categories' => $categoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('posts/form', $data);
    }

    public function update($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        // Authorization check
        if (empty($post) || $post['user_id'] != session()->get('id')) {
            return redirect()->to('/posts')->with('error', 'Anda tidak diizinkan untuk mengedit postingan ini.');
        }

        $rules = [
            'title' => 'required|min_length[5]',
            'content' => 'required',
            'category_id' => 'required|integer',
        ];
        
        // Optional thumbnail validation
        if ($this->request->getFile('thumbnail')->isValid()) {
            $rules['thumbnail'] = 'max_size[thumbnail,1024]|is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $title = $this->request->getPost('title');
        $slug = url_title($title, '-', true);

        // Ensure slug is unique, excluding the current post
        $originalSlug = $slug;
        $counter = 1;
        while ($postModel->isSlugTaken($slug, $id)) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id'),
            'status' => 'pending' // Reset status to pending after edit
        ];

        $thumbnailFile = $this->request->getFile('thumbnail');
        if ($thumbnailFile && $thumbnailFile->isValid()) {
            // Delete old thumbnail
            if ($post['thumbnail'] && file_exists('uploads/thumbnails/' . $post['thumbnail'])) {
                unlink('uploads/thumbnails/' . $post['thumbnail']);
            }
            $thumbnailName = $thumbnailFile->getRandomName();
            $thumbnailFile->move('uploads/thumbnails', $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }

        $postModel->update($id, $data);

        return redirect()->to('/posts')->with('message', 'Postingan berhasil diperbarui dan sedang menunggu persetujuan.');
    }


    public function delete($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);

        // Authorization check
        if (empty($post) || $post['user_id'] != session()->get('id')) {
            return redirect()->to('/posts')->with('error', 'Anda tidak diizinkan untuk menghapus postingan ini.');
        }

        // Delete thumbnail file
        if ($post['thumbnail'] && file_exists('uploads/thumbnails/' . $post['thumbnail'])) {
            unlink('uploads/thumbnails/' . $post['thumbnail']);
        }

        $postModel->delete($id);

        return redirect()->to('/posts')->with('message', 'Postingan berhasil dihapus.');
    }
}
