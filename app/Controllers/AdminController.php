<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CategoryModel;

class AdminController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Dashboard Admin',
            'pending_users_count' => $userModel->where('status', 'pending')->countAllResults()
        ];
        return view('admin/dashboard', $data);
    }

    // --- User Management ---

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

    public function manageUsers()
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $userModel->findAll()
        ];
        return view('admin/users/manage', $data);
    }

    public function editUser($id)
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Edit Pengguna',
            'user' => $userModel->find($id)
        ];

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengguna tidak ditemukan: ' . $id);
        }

        return view('admin/users/form', $data);
    }

    public function updateUser($id)
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
            'status' => $this->request->getPost('status'),
        ];

        // Optional: Update password if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to('/admin/users')->with('message', 'Data pengguna berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        // Prevent admin from deleting themselves
        if ($id == session()->get('id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/admin/users')->with('message', 'Pengguna berhasil dihapus.');
    }

    // --- Category Management ---

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
