<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        if (empty($arguments)) {
            return;
        }

        $userRole = session()->get('role_id');
        if (!in_array($userRole, $arguments)) {
            // Redirect to a 'permission denied' page or dashboard
            // For now, let's redirect to the dashboard with an error message
            return redirect()->to(site_url('dashboard'))->with('error', 'You do not have permission to access this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
