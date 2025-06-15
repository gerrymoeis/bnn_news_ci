<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role_id = session()->get('role_id');

        switch ($role_id) {
            case 1: // Admin
                return redirect()->to('/admin/dashboard');
            case 2: // Editor
                return redirect()->to('/editor/pending');
            case 3: // Wartawan
                return redirect()->to('/posts');
            default:
                // Jika peran tidak dikenali, logout dan kembali ke login
                session()->destroy();
                return redirect()->to('/login')->with('error', 'Peran pengguna tidak valid.');
        }
    }
}
