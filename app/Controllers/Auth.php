<?php

namespace App\Controllers;
use App\Models\UserModel;
class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('login')) {
            return redirect()->to('/');
        }
        $data = [
            'title' => "FAHP - Login",
        ];
        return view('auth/login');
    }
    public function validasi()
    {
        $session = session();

        $user = new UserModel;
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $row = $user->where('email', $email)->first();

        if ($row == NULL) {
            return redirect()->to('/Auth')->withInput()->with('errlog', 'Email tidak terdaftar');
        }
        if (password_verify($password, $row['password'])) {
            $data = [
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'login' => TRUE
            ];
            $session->set($data);
            return redirect()->to('/Dashboard');

        }
         return redirect()->to('/auth')->withInput()->with('errlog', 'Password Salah');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }
}
    