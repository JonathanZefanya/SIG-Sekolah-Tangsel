<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailSekolahModel extends Model
{
    protected $table            = 'detail_sekolah';
    protected $primaryKey       = 'det_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'det_guru', 'sek_npsn', 'det_siswa_p', 'det_siswa_l', 'det_akreditasi', 'det_akreditasi', 'det_kurikulum'
    ];
}
