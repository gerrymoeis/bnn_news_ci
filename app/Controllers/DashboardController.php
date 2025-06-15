<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        // Simple check to ensure user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'name' => session()->get('name'),
                'role_id' => session()->get('role_id')
            ]
        ];

        return view('dashboard/main_content', $data);
    }
}
