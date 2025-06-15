<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('id'));

        return view('profile/index', ['user' => $user, 'title' => 'Profil Saya']);
    }

    public function updateDetails()
    {
        $userModel = new UserModel();
        $id = session()->get('id');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        if ($userModel->update($id, $data)) {
            // Update session data as well
            session()->set([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
            return redirect()->to('/profile')->with('message', 'Detail profil berhasil diperbarui.');
        } else {
            return redirect()->to('/profile')->with('errors', $userModel->errors());
        }
    }

    public function updatePassword()
    {
        $userModel = new UserModel();
        $id = session()->get('id');
        $user = $userModel->find($id);

        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!password_verify($oldPassword, $user['password'])) {
            return redirect()->to('/profile')->with('error', 'Password lama salah.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->to('/profile')->with('error', 'Konfirmasi password baru tidak cocok.');
        }

        if (strlen($newPassword) < 8) {
            return redirect()->to('/profile')->with('error', 'Password baru minimal harus 8 karakter.');
        }

        $data = ['password' => $newPassword]; // Hashing is done by the model's callback

        if ($userModel->update($id, $data)) {
            return redirect()->to('/profile')->with('message', 'Password berhasil diperbarui.');
        } else {
            return redirect()->to('/profile')->with('errors', $userModel->errors());
        }
    }
}
