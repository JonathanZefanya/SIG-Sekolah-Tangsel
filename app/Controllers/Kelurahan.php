<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;

class Kelurahan extends BaseController
{
    protected $kelurahan, $kecamatan;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->kelurahan = new KelurahanModel();
        $this->kecamatan = new KecamatanModel();
    }
    public function index()
    {
        $data['kelurahan'] = $this->kelurahan->KecamatanJoin()->getResult();
        return view('auth/kelurahan/index', $data);
    }
    public function create()
    {
        $data['kecamatan'] = $this->kecamatan->findAll();
        return view('auth/kelurahan/create', $data);
    }
    public function save()
    {
        $validation = $this->validate([
            'kec_id' => [
                'rules' => 'required'
            ],
            'kel_name' => [
                'rules' => 'required|is_unique[kelurahan.kel_name]'
            ],
        ]);
        if (!$validation) {
            return redirect()->to('/kel/create')->withInput();
        }
        $this->kelurahan->insert([
            'kec_id'   => $this->request->getPost('kec_id'),
            'kel_name'   => $this->request->getPost('kel_name'),
        ]);
        session()->setFlashdata('message', 'Data kelurahan berhasil disimpan');
        return redirect()->to('/kel');
    }
    public function edit($id)
    {
        $data['kel'] = $this->kelurahan->where('kel_id', $id)->first();
        $data['kecamatan'] = $this->kecamatan->findAll();
        return view('auth/kelurahan/edit', $data);
    }
    public function update($id)
    {
        $kelOld = $this->kelurahan->where('kel_id', $id)->first();
        if ($kelOld->kel_name == $this->request->getVar('kel_name')) {
            $rule_name = 'required';
        } else {
            $rule_name = 'required|is_unique[kelurahan.kel_name]';
        }
        $validation = $this->validate([
            'kec_id' => [
                'rules'  => 'required',
            ],
            'kel_name' => [
                'rules'  => $rule_name,
            ],
        ]);

        if (!$validation) {
            return redirect()->to('/kel/edit/' . $id)->withInput();
        }
        $this->kelurahan->update($id, [
            'kec_id'   => $this->request->getPost('kec_id'),
            'kel_name'   => $this->request->getPost('kel_name'),
        ]);
        session()->setFlashdata('message', 'Data kelurahan berhasil dirubah.');
        return redirect()->to('/kel');
    }
    public function delete($id)
    {
        $this->kelurahan->delete($id);
        session()->setFlashdata('message', 'Data kelurahan berhasil dihapus');
        return redirect()->to('/kel');
    }
}
