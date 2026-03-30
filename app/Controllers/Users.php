<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|is_unique[users.email]'
        ];

        if(!$this->validate($rules))
            {
                return view('users/create', [
                    'validation' => $this->validator
                ]);
            }

        $model = new UserModel();

        $model->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/users');

    }
    public function edit($id)
    {
        $model = new UserModel();

        $data['user'] = $model->find($id);

        return view('users/edit', $data);

    }

    public function update($id) 
    {
        $rules = [
            'name' => 'required|min_length[3]'
        ];

        if(!$this->validate($rules)):
            return view('users/edit', [
                'validation' => $this->validator
            ]);

        endif;

        $model = new UserModel();

        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ]);
         return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserModel();

        $model->delete($id);

        return redirect()->to('/users/product');
    }

    public function product()
    {
        $model = new Usermodel();

        $data['sims'] = $model->findall();


        return view('users/product', $data);
    }
}