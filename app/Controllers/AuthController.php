<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function registerPage()
    {
        return view('auth/register');
    }
    public function register()
    {
        $userModel = new UsersModel();
        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ];

        $userModel->insert($data);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Registration successful!']);
    }

    // ========================
    // Login User (AJAX)
    // ========================
    public function login()
    {
        $userModel = new UsersModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found!']);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid password!']);
        }

        // Store session
        session()->set([
            'id' => $user['id'],
            'name' => ucfirst($user['name']),
            'email' => $user['email'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

        // ✅ Redirect URL based on role
        $redirectUrl = '';
        if ($user['role'] === 'student') {
            $redirectUrl = base_url('student/dashboard');
        } elseif ($user['role'] === 'instructor') {
            $redirectUrl = base_url('instructor/dashboard');
        } elseif ($user['role'] === 'admin') {
            $redirectUrl = base_url('admin/dashboard');
        }

        // return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful!']);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Login successful!',
            'redirect' => $redirectUrl
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
