<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CategoryModel;

class AdminController extends BaseController
{
    public function pendingUsers()
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Persetujuan Pengguna',
            'users' => $userModel->where('status', 'pending')->findAll()
        ];
        return view('admin/users/pending', $data);
    }

    public function approveUser($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, ['status' => 'approved']);
        return redirect()->to('/admin/users/pending')->with('message', 'Pengguna telah disetujui.');
    }

    public function rejectUser($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin/users/pending')->with('message', 'Pengguna telah ditolak dan dihapus.');
    }

    public function manageCategories()
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Manajemen Kategori',
            'categories' => $categoryModel->findAll()
        ];
        return view('admin/categories/manage', $data);
    }

    public function createCategory()
    {
        return view('admin/categories/form', ['title' => 'Tambah Kategori Baru']);
    }

    public function storeCategory()
    {
        $categoryModel = new CategoryModel();
        $data = ['name' => $this->request->getPost('name')];
        $categoryModel->save($data);
        return redirect()->to('/admin/categories/manage')->with('message', 'Kategori berhasil ditambahkan.');
    }

    public function editCategory($id)
    {
        $categoryModel = new CategoryModel();
        $data = [
            'title' => 'Edit Kategori',
            'category' => $categoryModel->find($id)
        ];
        return view('admin/categories/form', $data);
    }

    public function updateCategory($id)
    {
        $categoryModel = new CategoryModel();
        $data = ['name' => $this->request->getPost('name')];
        $categoryModel->update($id, $data);
        return redirect()->to('/admin/categories/manage')->with('message', 'Kategori berhasil diperbarui.');
    }

    public function deleteCategory($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);
        return redirect()->to('/admin/categories/manage')->with('message', 'Kategori berhasil dihapus.');
    }
}
