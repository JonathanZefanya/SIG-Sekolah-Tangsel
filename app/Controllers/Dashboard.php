<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SekolahModel;

class Dashboard extends BaseController
{
    protected $sekolah;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->sekolah = new SekolahModel();
    }
    public function index()
    {
        if (session()->get('user_akses') != 'sekolah') {
            $data['sekolahs'] = $this->sekolah->getDetailSekolah();
            $data['sd'] = $this->sekolah->where('sek_jenjang', 'sd')->findAll();
            $data['smp'] = $this->sekolah->where('sek_jenjang', 'smp')->findAll();
            $data['sma'] = $this->sekolah->where('sek_jenjang', 'sma')->findAll();
        } else {
            $user_id = session()->get('user_id');
            $data['sekolah'] = $this->sekolah->getDetailUserSekolah($user_id);
        }
        return view('dashboard/index', $data);
    }
}
