<?php

namespace App\Controllers;

use App\Models\SekolahModel;
use App\Models\ChatConfigModel;

class Home extends BaseController
{
    public function index()
    {
        $sekolah = new SekolahModel();
        $configModel = new ChatConfigModel();
        $config = $configModel->first();

        $data = [
            'sekolahs' => $sekolah->getDetailSekolah(),
            'sd' => $sekolah->where('sek_jenjang', 'sd')->findAll(),
            'smp' => $sekolah->where('sek_jenjang', 'smp')->findAll(),
            'sma' => $sekolah->where('sek_jenjang', 'sma')->findAll(),
            'chatbot_enabled' => $config['is_enabled'] ?? false
        ];

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
