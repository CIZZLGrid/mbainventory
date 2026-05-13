<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
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

        echo password_hash('admin123', PASSWORD_DEFAULT);

        if ($admin)
            {
                if(password_verify($password, $admin['password']))
                    {
                    
                session()->set([
                    'admin_id' => $admin['id'],
                    'username' => $admin['username'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to(site_url('users/product'));
                    }else
                    {
                    return redirect()->back()->with('error', 'Invalid Password');
                    
                    }
            }
            else{
                return redirect()->back()->with('error', 'Username not found');
            }

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
