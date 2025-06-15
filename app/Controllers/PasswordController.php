<?php

namespace App\Controllers;

use App\Models\UserModel;

class PasswordController extends BaseController
{
    public function forgot()
    {
        return view('password/forgot');
    }

    public function processForgot()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            $token = bin2hex(random_bytes(20));
            $expires = date('Y-m-d H:i:s', time() + 3600); // 1 hour

            $userModel->update($user['id'], [
                'reset_token' => $token,
                'reset_expires' => $expires,
            ]);

            // For simplicity, we'll just show the link. In a real app, you'd email this.
            $resetLink = site_url('password/reset/' . $token);
            return redirect()->to('/password/forgot')->with('message', 'Tautan reset password telah dikirim (secara simulasi): ' . $resetLink);
        }

        return redirect()->to('/password/forgot')->with('error', 'Email tidak ditemukan.');
    }

    public function reset($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
                          ->where('reset_expires >', date('Y-m-d H:i:s'))
                          ->first();

        if ($user) {
            return view('password/new_form', ['token' => $token]);
        }

        return redirect()->to('/password/forgot')->with('error', 'Tautan reset tidak valid atau telah kedaluwarsa.');
    }

    public function processReset()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            return redirect()->back()->withInput()->with('error', 'Password tidak cocok.');
        }

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
                          ->where('reset_expires >', date('Y-m-d H:i:s'))
                          ->first();

        if ($user) {
            $userModel->update($user['id'], [
                'password' => $password, // The model's beforeUpdate callback will hash it
                'reset_token' => null,
                'reset_expires' => null,
            ]);

            return redirect()->to('/login')->with('message', 'Password Anda telah berhasil direset.');
        }

        return redirect()->to('/password/forgot')->with('error', 'Gagal mereset password. Tautan tidak valid.');
    }
}
