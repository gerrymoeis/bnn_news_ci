<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        helper(['form', 'url']);
    }

    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login'); // Pastikan view ini ada
    }

    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            $userData = [
                'user_id'  => $user['id'],
                'username' => $user['name'], // Menggunakan 'name' sesuai UserModel
                'email'    => $user['email'],
                'role_id'  => $user['role_id'], // Pastikan kolom role_id ada di tabel users
                'isLoggedIn' => true,
            ];
            $this->session->set($userData);
            return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }
    }

    public function register()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register'); // Pastikan view ini ada
    }

    public function attemptRegister()
    {
        $rules = [
            'name'         => 'required|min_length[3]|max_length[255]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'role_id'      => 'required|in_list[2,3]', // Memastikan peran yang dipilih valid
            'password'     => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'), // Hashing ditangani oleh UserModel
            'role_id'  => $this->request->getPost('role_id'), // Mengambil peran dari form
            'status'   => 'pending' // Akun baru perlu persetujuan Admin
        ];

        if ($this->userModel->save($data)) {
            return redirect()->to('/login')->with('success', 'Registrasi berhasil! Akun Anda akan aktif setelah disetujui oleh Admin.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Registrasi gagal, silakan coba lagi.');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}
