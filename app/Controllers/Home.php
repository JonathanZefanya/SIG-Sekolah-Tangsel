<?php

namespace App\Controllers;

use App\Models\SekolahModel;

class Home extends BaseController
{
    public function index()
    {
        $sekolah = new SekolahModel();
        $data['sekolahs'] = $sekolah->getDetailSekolah();
        $data['sd'] = $sekolah->where('sek_jenjang', 'sd')->findAll();
        $data['smp'] = $sekolah->where('sek_jenjang', 'smp')->findAll();
        $data['sma'] = $sekolah->where('sek_jenjang', 'sma')->findAll();
        return view('home/app', $data);
    }
    public function show($id)
    {
        $sekolah = new SekolahModel();
        $data['sekolah'] = $sekolah->getDetailSekolahId($id);
        return view('home/show', $data);
    }
    public function rute($id)
    {
        $sekolah = new SekolahModel();
        $data['sekolah'] = $sekolah->getDetailSekolahId($id);
        return view('home/rute', $data);
    }
}
