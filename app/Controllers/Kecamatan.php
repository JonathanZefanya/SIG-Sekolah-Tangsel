<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;

class Kecamatan extends BaseController
{
    protected $kecamatan;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->kecamatan = new KecamatanModel();
    }
    public function index()
    {
        $data['kecamatan'] = $this->kecamatan->findAll();
        return view('auth/kecamatan/index', $data);
    }
    public function create()
    {
        return view('auth/kecamatan/create');
    }
    public function save()
    {
        $validation = $this->validate([
            'kec_name' => [
                'rules' => 'required|is_unique[kecamatan.kec_name]'
            ],
        ]);
        if (!$validation) {
            return redirect()->to('/kec/create')->withInput();
        }
        $this->kecamatan->insert([
            'kec_name'   => $this->request->getPost('kec_name'),
        ]);
        session()->setFlashdata('message', 'Data kecamatan berhasil disimpan');
        return redirect()->to('/kec');
    }
    public function edit($id)
    {
        $data['kec'] = $this->kecamatan->where('kec_id', $id)->first();
        return view('auth/kecamatan/edit', $data);
    }
    public function update($id)
    {
        $kecOld = $this->kecamatan->where('kec_id', $id)->first();
        if ($kecOld->kec_name == $this->request->getVar('kec_name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[kecamatan.kec_name]';
        }
        $validation = $this->validate([
            'kec_name' => [
                'rules'  => $rule_name,
            ],
        ]);

        if (!$validation) {
            return redirect()->to('/kec/edit/' . $id)->withInput();
        }
        $this->kecamatan->update($id, [
            'kec_name'   => $this->request->getPost('kec_name'),
        ]);
        session()->setFlashdata('message', 'Data kecamatan berhasil dirubah.');
        return redirect()->to('/kec');
    }
    public function delete($id)
    {
        $this->kecamatan->delete($id);
        session()->setFlashdata('message', 'Data kecamatan berhasil dihapus');
        return redirect()->to('/kec');
    }
}
