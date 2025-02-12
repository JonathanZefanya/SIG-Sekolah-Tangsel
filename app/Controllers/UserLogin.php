<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use App\Models\User;

class UserLogin extends BaseController
{
    protected $user, $sekolah;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->user = new User();
        $this->sekolah = new SekolahModel();
    }
    public function index()
    {
        $data['users'] = $this->user->findAll();
        return view('auth/user/index', $data);
    }
    public function create()
    {
        return view('auth/user/create');
    }
    public function save()
    {
        $validation = $this->validate([
            'user_name' => [
                'rules'  => 'required'
            ],
            'user_email' => [
                'rules' => 'required|is_unique[user.user_email]|valid_email'
            ],
            'user_akses' => [
                'rules' => 'required|in_list[sekolah,dinas]',
            ],
        ]);
        if (!$validation) {
            return redirect()->to('/user/create')->withInput();
        }
        $this->user->insert([
            'user_name'   => $this->request->getPost('user_name'),
            'user_email' => $this->request->getPost('user_email'),
            'user_password' => password_hash($this->request->getPost('user_akses') . '123', PASSWORD_DEFAULT),
            'user_akses' => $this->request->getPost('user_akses'),
        ]);
        session()->setFlashdata('message', 'Data login berhasil disimpan');
        return redirect()->to('/user');
    }
    public function edit($id)
    {
        $data['user'] = $this->user->where('user_id', $id)->first();
        return view('auth/user/edit', $data);
    }
    public function update($id)
    {
        $usersOld = $this->user->where('user_id', $id)->first();
        if ($usersOld->user_email == $this->request->getVar('user_email')) {
            $rule_email = 'required|valid_email';
        } else {
            $rule_email = 'required|is_unique[user.user_email]|valid_email';
        }
        $validation = $this->validate([
            'user_name' => [
                'rules'  => 'required',
            ],
            'user_email' => [
                'rules' => $rule_email,
            ],
            'user_akses' => [
                'rules' => 'required|in_list[sekolah,dinas]',
            ],
        ]);

        if (!$validation) {
            return redirect()->to('/user/edit/' . $id)->withInput();
        }
        $this->user->update($id, [
            'user_name'   => $this->request->getPost('user_name'),
            'user_email' => $this->request->getPost('user_email'),
            'user_akses' => $this->request->getPost('user_akses'),
        ]);
        session()->setFlashdata('message', 'User berhasil dirubah.');
        return redirect()->to('/user');
    }
    public function delete($id)
    {
        $user = $this->user->where('user_id', $id)->first();
        if ($user->user_akses == "sekolah") {
            $sekolah = $this->sekolah->where('user_id', $user->user_id)->first();
            $this->sekolah->update($sekolah->sek_npsn, [
                'user_id' => NULL,
            ]);
        }
        $this->user->delete($id);
        session()->setFlashdata('message', 'Data login berhasil dihapus');
        return redirect()->to('/user');
    }
}
