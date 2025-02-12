<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function verificationLogin()
    {
        $user = new User();
        $email = $this->request->getVar('user_email');
        $password = $this->request->getVar('user_password');
        $dataUser = $user->where([
            'user_email' => $email,
        ])->first();

        if (!$dataUser || !password_verify($password, $dataUser->user_password)) {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }

        session()->set([
            'user_id' => $dataUser->user_id,
            'user_name' => $dataUser->user_name,
            'user_email' => $dataUser->user_email,
            'user_akses' => $dataUser->user_akses,
            'logged_in' => TRUE
        ]);
        return redirect()->to(base_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
