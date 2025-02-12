<?php

namespace App\Models;

use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $table            = 'kelurahan';
    protected $primaryKey       = 'kel_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['kec_id', 'kel_name'];

    public function KecamatanJoin()
    {
        return $this->select('*')
            ->join('kecamatan', 'kecamatan.kec_id=kelurahan.kec_id')
            ->get();
    }
    public function getWhereKecamatan($id)
    {
        return $this->select('*')
            // ->join('kecamatan', 'kecamatan.kec_id=kelurahan.kec_id')
            ->get();
    }
}
