<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        // if (!session()->get('logged_in')) {
        //     return redirect()->to(base_url('login'));
        // }

        $userModel = new UsersModel();
        $user = $userModel->find(session()->get('id'));

        return view('profile', ['user' => $user]);
    }

    public function updateProfile()
    {

        $validation = \Config\Services::validation();

        $rules = [
            'name'  => 'required|min_length[3]',
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => implode(', ', $validation->getErrors())
            ]);
        }
        $userModel = new UsersModel();
        $id = session()->get('id');

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        $userModel->update($id, $data);
        session()->set($data); // update session data

        return $this->response->setJSON(['status' => 'success', 'message' => 'Profile updated successfully!']);
    }

    
}
