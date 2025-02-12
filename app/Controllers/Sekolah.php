<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailSekolahModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\SekolahModel;
use App\Models\User;

class Sekolah extends BaseController
{
    protected $sekolah, $detail_sekolah, $kelurahan, $kecamatan, $user;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->user = new User();
        $this->sekolah = new SekolahModel();
        $this->detail_sekolah = new DetailSekolahModel();
        $this->kelurahan = new KelurahanModel();
        $this->kecamatan = new KecamatanModel();
    }
    public function index()
    {
        if (session()->get('user_akses') != 'sekolah') {
            $data['sekolahs'] = $this->sekolah->getDetailSekolah();
        } else {
            $user_id = session()->get('user_id');
            $data['sekolah'] = $this->sekolah->getDetailUserSekolah($user_id);
        }
        return view('auth/sekolah/index', $data);
    }
    public function show($id)
    {
        $sekolah = new SekolahModel();
        $sklh = $sekolah->where('sek_npsn', $id)->first();
        if ($sklh->user_id != null) {
            $data['sekolah'] = $sekolah->getDetailSekolahIdUser($id);
        } else {
            $data['sekolah'] = $sekolah->getDetailSekolahId($id);
        }
        return view('auth/sekolah/show', $data);
    }
    public function create()
    {
        $data['kecamatan'] = $this->kecamatan->findAll();
        $data['users'] =  $this->user->where('user_akses =', 'sekolah')->findAll();
        return view('auth/sekolah/create', $data);
    }
    public function save()
    {
        $validation = $this->validate([
            'sek_npsn' => [
                'rules'  => 'required|is_unique[sekolah.sek_npsn]',
            ],
            'sek_nama' => [
                'rules'  => 'required',
            ],
            'sek_status' => [
                'rules'  => 'required|in_list[negeri,swasta]',
            ],
            'sek_jenjang' => [
                'rules'  => 'required|in_list[sd,smp,sma]',
            ],
            'sek_alamat' => [
                'rules'  => 'required',
            ],
            'kel_id' => [
                'rules'  => 'required',
            ],
            'kec_id' => [
                'rules'  => 'required',
            ],
            'sek_lokasi' => [
                'rules'  => 'required',
            ],
            'det_guru' => [
                'rules'  => 'required',
            ],
            'det_siswa_p' => [
                'rules'  => 'required',
            ],
            'det_siswa_l' => [
                'rules'  => 'required',
            ],
            'det_akreditasi' => [
                'rules'  => 'required|in_list[a,b,c]',
            ],
            'det_kurikulum' => [
                'rules'  => 'required',
            ],
        ]);
        if (!$validation) {
            return redirect()->to('/sekolah/create')->withInput();
        }
        if ($this->request->getVar('user_id') != "NULL") {
            $user_id = $this->request->getVar('user_id');
        } else {
            $user_id = NULL;
        }
        $this->sekolah->insert([
            'sek_npsn' => $this->request->getPost('sek_npsn'),
            'user_id' => $user_id,
            'sek_nama' => strtolower($this->request->getVar('sek_nama')),
            'sek_status' => $this->request->getPost('sek_status'),
            'sek_jenjang' => $this->request->getPost('sek_jenjang'),
            'sek_alamat' => strtolower($this->request->getVar('sek_alamat')),
            'kel_id' => $this->request->getPost('kel_id'),
            'kec_id' => $this->request->getPost('kec_id'),
            'sek_lokasi' => $this->request->getPost('sek_lokasi'),
        ]);
        $this->detail_sekolah->insert([
            'sek_npsn' => $this->request->getPost('sek_npsn'),
            'det_guru' => $this->request->getPost('det_guru'),
            'det_siswa_p' => $this->request->getPost('det_siswa_p'),
            'det_siswa_l' => $this->request->getPost('det_siswa_l'),
            'det_akreditasi' => $this->request->getPost('det_akreditasi'),
            'det_kurikulum' => $this->request->getPost('det_kurikulum'),
        ]);
        session()->setFlashdata('message', 'Data sekolah berhasil ditambahkan.');
        return redirect()->to('/sekolah');
    }
    public function edit($id)
    {
        $data['sekolah'] = $this->sekolah->where('sek_npsn', $id)->first();
        $data['kecamatan'] = $this->kecamatan->findAll();
        $data['kelurahan'] = $this->kelurahan->findAll();
        $data['det_sekolah'] = $this->detail_sekolah->where('sek_npsn', $id)->first();
        $data['users'] =  $this->user->where('user_akses =', 'sekolah')->findAll();
        return view('auth/sekolah/edit', $data);
    }
    public function update($id)
    {
        $validation = $this->validate([
            'sek_npsn' => [
                'rules'  => 'required',
            ],
            'sek_nama' => [
                'rules'  => 'required',
            ],
            'sek_status' => [
                'rules'  => 'required|in_list[negeri,swasta]',
            ],
            'sek_jenjang' => [
                'rules'  => 'required|in_list[sd,smp,sma]',
            ],
            'sek_alamat' => [
                'rules'  => 'required',
            ],
            'kel_id' => [
                'rules'  => 'required',
            ],
            'kec_id' => [
                'rules'  => 'required',
            ],
            'sek_lokasi' => [
                'rules'  => 'required',
            ],
            'det_guru' => [
                'rules'  => 'required',
            ],
            'det_siswa_p' => [
                'rules'  => 'required',
            ],
            'det_siswa_l' => [
                'rules'  => 'required',
            ],
            'det_akreditasi' => [
                'rules'  => 'required|in_list[a,b,c]',
            ],
            'det_kurikulum' => [
                'rules'  => 'required',
            ],
        ]);
        if (!$validation) {
            return redirect()->to('/sekolah/edit/' . $id)->withInput();
        }
        $idDetailSekolah = $this->request->getVar('det_id');
        if ($this->request->getVar('user_id') != "NULL") {
            $user_id = $this->request->getVar('user_id');
        } else {
            $user_id = NULL;
        }
        $this->sekolah->update($id, [
            'sek_npsn' => $this->request->getPost('sek_npsn'),
            'user_id' => $user_id,
            'sek_nama' => strtolower($this->request->getVar('sek_nama')),
            'sek_status' => $this->request->getPost('sek_status'),
            'sek_jenjang' => $this->request->getPost('sek_jenjang'),
            'sek_alamat' => strtolower($this->request->getVar('sek_alamat')),
            'kel_id' => $this->request->getPost('kel_id'),
            'kec_id' => $this->request->getPost('kec_id'),
            'sek_lokasi' => $this->request->getPost('sek_lokasi'),
        ]);
        $this->detail_sekolah->update($idDetailSekolah, [
            'sek_npsn' => $this->request->getPost('sek_npsn'),
            'det_guru' => $this->request->getPost('det_guru'),
            'det_siswa_p' => $this->request->getPost('det_siswa_p'),
            'det_siswa_l' => $this->request->getPost('det_siswa_l'),
            'det_akreditasi' => $this->request->getPost('det_akreditasi'),
            'det_kurikulum' => $this->request->getPost('det_kurikulum'),
        ]);
        session()->setFlashdata('message', 'Data sekolah berhasil dirubah.');
        return redirect()->to('/sekolah');
    }
    public function delete($id)
    {
        $detail_sekolah = $this->detail_sekolah->where('sek_npsn', $id)->first();
        $sekolah = $this->sekolah->where('sek_npsn', $id)->first();
        $this->detail_sekolah->delete($detail_sekolah->sek_npsn);
        unlink('assets/images/sekolah/' . $sekolah->sek_foto);
        $this->sekolah->delete($id);
        session()->setFlashdata('message', 'Data sekolah berhasil dihapus');
        return redirect()->to('/sekolah');
    }
}
