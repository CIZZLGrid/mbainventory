<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $model = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $model->where('username', $username)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Username not found');
        }

        if (!password_verify($password, $admin['password'])) {
            return redirect()->back()->with('error', 'Invalid Password');
        }

        session()->set([
            'admin_id'   => $admin['id'],
            'username'   => $admin['username'],
            'role'       => $admin['role'],
            'isLoggedIn' => true,
        ]);

        if ($admin['role'] === 'superadmin') {
            return redirect()->to('/users/admin_management');
        }

        return redirect()->to('/users/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}