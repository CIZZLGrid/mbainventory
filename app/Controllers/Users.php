<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
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
    public function globe_sim()
    {
        return view('layout/add_globe');    
    }
    public function smart_sim()
    {
        return view('layout/add_smart');    
    }
    public function add_globe()
    {
        $model = new UserModel();

        $model->save([
            'sim_gateway' => $this->request->getPost('sim_gateway'),
            'sim_id' => $this->request->getPost('sim_id'),
            'sim_no' => $this->request->getPost('sim_no'),
            'direction' => $this->request->getPost('direction'),
            'call_to' => $this->request->getPost('call_to'),
            'sms_to' => $this->request->getPost('sms_to'),
            'operator' => $this->request->getPost('operator'),
        ]);

        return redirect()->to('/users/product');    
    }
    public function add_smart()
    {
        $model = new UserModel();

        $model->save([
            'sim_gateway' => $this->request->getPost('sim_gateway'),
            'sim_id' => $this->request->getPost('sim_id'),
            'sim_no' => $this->request->getPost('sim_no'),
            'direction' => $this->request->getPost('direction'),
            'call_to' => $this->request->getPost('call_to'),
            'sms_to' => $this->request->getPost('sms_to'),
            'operator' => $this->request->getPost('operator'),
        ]);

        return redirect()->to('/users/product');    
    }
    public function edit_sim($id)
    {
        $model = new UserModel();

        $data['sims'] = $model->find($id);

        return view('layout/edit_sim', $data);
    }
    public function update_sim($id)
    {
        $model = new UserModel();

        $model->update($id, [
            'sim_gateway' => $this->request->getPost('sim_gateway'),
            'sim_id' => $this->request->getPost('sim_id'),
            'sim_no' => $this->request->getPost('sim_no'),
            'direction' => $this->request->getPost('direction'),
            'call_to' => $this->request->getPost('call_to'),
            'sms_to' => $this->request->getPost('sms_to'),
            'operator' => $this->request->getPost('operator'),  
        ]);
         return redirect()->to('/users/product');

    }
}