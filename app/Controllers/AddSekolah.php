<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;

class AddSekolah extends BaseController
{
    protected $kelurahan, $kecamatan;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->kelurahan = new KelurahanModel();
    }
    public function getData()
    {
        $kec_id = $this->request->getPost('kecamatan');
        $data = $this->kelurahan->where('kec_id', $kec_id)->findAll();
        echo json_encode($data);
    }
}
