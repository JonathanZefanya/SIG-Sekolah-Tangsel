<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table            = 'sekolah';
    protected $primaryKey       = 'sek_npsn';
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'sek_npsn', 'user_id', 'sek_nama', 'sek_status', 'sek_jenjang', 'sek_alamat', 'kel_id', 'kec_id', 'sek_lokasi',
    ];

    public function getDetailSekolah()
    {
        return $this->select('*')
            ->join('detail_sekolah', 'detail_sekolah.sek_npsn=sekolah.sek_npsn')
            ->join('kelurahan', 'kelurahan.kel_id=sekolah.kel_id')
            ->join('kecamatan', 'kecamatan.kec_id=sekolah.kec_id')
            ->get()->getResult();
    }
    public function getDetailUserSekolah($id)
    {
        return $this->select('*')
            ->join('detail_sekolah', 'detail_sekolah.sek_npsn=sekolah.sek_npsn')
            ->join('kelurahan', 'kelurahan.kel_id=sekolah.kel_id')
            ->join('kecamatan', 'kecamatan.kec_id=sekolah.kec_id')
            ->where('sekolah.user_id', $id)
            ->first();
    }
    public function getDetailSekolahIdUser($id)
    {
        return $this->select('*')
            ->join('detail_sekolah', 'detail_sekolah.sek_npsn=sekolah.sek_npsn')
            ->join('kelurahan', 'kelurahan.kel_id=sekolah.kel_id')
            ->join('kecamatan', 'kecamatan.kec_id=sekolah.kec_id')
            ->join('user', 'user.user_id=sekolah.user_id')
            ->where('sekolah.sek_npsn', $id)
            ->first();
    }
    public function getDetailSekolahId($id)
    {
        return $this->select('*')
            ->join('detail_sekolah', 'detail_sekolah.sek_npsn=sekolah.sek_npsn')
            ->join('kelurahan', 'kelurahan.kel_id=sekolah.kel_id')
            ->join('kecamatan', 'kecamatan.kec_id=sekolah.kec_id')
            ->where('sekolah.sek_npsn', $id)
            ->first();
    }
}
