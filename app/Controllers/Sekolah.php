<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DetailSekolahModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\SekolahModel;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            'det_website' => [
                'rules'  => 'required',
            ],
            'gambar' => [
                'rules'  => 'uploaded[gambar]|max_size[gambar,5024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
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

        // Handle Upload File
        $gambar = $this->request->getFile('gambar');
        $gambarNama = $gambar->getRandomName();
        $gambar->move('uploads/sekolah', $gambarNama); // Simpan ke public/uploads/sekolah

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
            'det_website' => $this->request->getPost('det_website'),
            'gambar' => $gambarNama,
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
            'det_website' => [
                'rules'  => 'required',
            ],
            'gambar' => [
                'rules'  => 'max_size[gambar,5024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
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

        // Ambil data lama
        $oldData = $this->detail_sekolah->where('sek_npsn', $id)->first();

        // Cek apakah ada file gambar baru diunggah
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $newName = $gambar->getRandomName();
            $gambar->move('uploads/sekolah', $newName); // Simpan gambar baru

            // Hapus gambar lama jika ada
            if ($oldData && !empty($oldData->gambar) && file_exists('uploads/sekolah/' . $oldData->gambar)) {
                unlink('uploads/sekolah/' . $oldData->gambar);
            }
        } else {
            $newName = $this->request->getPost('gambar_lama'); // Gunakan gambar lama jika tidak ada yang baru
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
            'det_website' => $this->request->getPost('det_website'),
            'gambar' => $newName,
        ]);
        session()->setFlashdata('message', 'Data sekolah berhasil dirubah.');
        return redirect()->to('/sekolah');
    }
    public function delete($id)
    {
        // Ambil data detail sekolah
        $detail_sekolah = $this->detail_sekolah->where('sek_npsn', $id)->first();
        $sekolah = $this->sekolah->where('sek_npsn', $id)->first();

        // Pastikan data ditemukan sebelum menghapus
        if ($detail_sekolah) {
            // Hapus gambar jika ada
            if (!empty($detail_sekolah->gambar) && file_exists('uploads/sekolah/' . $detail_sekolah->gambar)) {
                unlink('uploads/sekolah/' . $detail_sekolah->gambar);
            }

            // Hapus data dari tabel detail_sekolah
            $this->detail_sekolah->delete($detail_sekolah->sek_npsn);
        }

        // Hapus data dari tabel sekolah jika ada
        if ($sekolah) {
            $this->sekolah->delete($id);
        }

        session()->setFlashdata('message', 'Data sekolah berhasil dihapus');
        return redirect()->to('/sekolah');
    }

    public function import()
    {
        $fileSekolah = $this->request->getFile('file_excel_sekolah');
        $fileDetail = $this->request->getFile('file_excel_detail');

        if ($fileSekolah->isValid() && !$fileSekolah->hasMoved() && $fileDetail->isValid() && !$fileDetail->hasMoved()) {
            $spreadsheetSekolah = IOFactory::load($fileSekolah->getTempName());
            $spreadsheetDetail = IOFactory::load($fileDetail->getTempName());

            $sheetSekolah = $spreadsheetSekolah->getActiveSheet();
            $dataSekolah = $sheetSekolah->toArray();

            $sheetDetail = $spreadsheetDetail->getActiveSheet();
            $dataDetail = $sheetDetail->toArray();

            $errors = [];

            foreach ($dataSekolah as $key => $row) {
                if ($key == 0) continue; 

                if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4]) || empty($row[5]) || empty($row[6]) || empty($row[7])) {
                    $errors[] = "Baris " . ($key + 1) . " di Data Sekolah memiliki format tidak sesuai.";
                    continue;
                }

                $existingSekolah = $this->sekolah->where('sek_npsn', $row[0])->first();
                if ($existingSekolah) {
                    $errors[] = "NPSN " . $row[0] . " sudah terdaftar di database.";
                    continue;
                }

                $kelurahanExists = $this->kelurahan->where('kel_id', $row[5])->first();
                if (!$kelurahanExists) {
                    $errors[] = "Kelurahan ID " . $row[5] . " tidak ditemukan.";
                    continue;
                }

                $this->sekolah->insert([
                    'sek_npsn' => $row[0],
                    'sek_nama' => strtolower($row[1]),
                    'sek_status' => $row[2],
                    'sek_jenjang' => $row[3],
                    'sek_alamat' => strtolower($row[4]),
                    'kel_id' => $row[5],
                    'kec_id' => $row[6],
                    'sek_lokasi' => $row[7],
                ]);
            }

            foreach ($dataDetail as $key => $row) {
                if ($key == 0) continue; 

                if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4]) || empty($row[5]) || empty($row[6])) {
                    $errors[] = "Baris " . ($key + 1) . " di Data Detail Sekolah memiliki format tidak sesuai.";
                    continue;
                }

                $existingSekolah = $this->sekolah->where('sek_npsn', $row[1])->first();
                if (!$existingSekolah) {
                    $errors[] = "NPSN " . $row[1] . " tidak ditemukan di tabel sekolah.";
                    continue;
                }

                $existingDetail = $this->detail_sekolah->where('sek_npsn', $row[1])->first();
                if ($existingDetail) {
                    $errors[] = "Detail untuk NPSN " . $row[1] . " sudah ada.";
                    continue;
                }

                $this->detail_sekolah->insert([
                    'det_id' => $row[0],
                    'sek_npsn' => $row[1],
                    'det_guru' => $row[2],
                    'det_siswa_p' => $row[3],
                    'det_siswa_l' => $row[4],
                    'det_akreditasi' => $row[5],
                    'det_kurikulum' => $row[6],
                    'det_website' => $row[7] ?? "-",
                    'gambar' => $row[8] ?? null,
                ]);
            }

            if (!empty($errors)) {
                return redirect()->to('/sekolah/import')->with('error', implode("<br>", $errors));
            }

            return redirect()->to('/sekolah')->with('message', 'Data berhasil diimpor.');
        }

        return redirect()->to('/sekolah/import')->with('error', 'File tidak valid.');
    }

    public function importPage()
    {
        return view('auth/sekolah/import');
    }
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NPSN');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Status');
        $sheet->setCellValue('D1', 'Jenjang');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Kelurahan');
        $sheet->setCellValue('G1', 'Kecamatan');
        $sheet->setCellValue('H1', 'Lokasi');

        $sekolahData = $this->sekolah->findAll();
        $rowIndex = 2;

        foreach ($sekolahData as $data) {
            $data = (array) $data; // Konversi object ke array
            $sheet->setCellValue('A' . $rowIndex, $data['sek_npsn']);
            $sheet->setCellValue('B' . $rowIndex, $data['sek_nama']);
            $sheet->setCellValue('C' . $rowIndex, $data['sek_status']);
            $sheet->setCellValue('D' . $rowIndex, $data['sek_jenjang']);
            $sheet->setCellValue('E' . $rowIndex, $data['sek_alamat']);
            $sheet->setCellValue('F' . $rowIndex, $data['kel_id']);
            $sheet->setCellValue('G' . $rowIndex, $data['kec_id']);
            $sheet->setCellValue('H' . $rowIndex, $data['sek_lokasi']);
            $rowIndex++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Data_Sekolah_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    public function exportDetailSekolah()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NPSN');
        $sheet->setCellValue('C1', 'Jumlah Guru');
        $sheet->setCellValue('D1', 'Siswa Perempuan');
        $sheet->setCellValue('E1', 'Siswa Laki-Laki');
        $sheet->setCellValue('F1', 'Akreditasi');
        $sheet->setCellValue('G1', 'Kurikulum');
        $sheet->setCellValue('H1', 'Website');
        $sheet->setCellValue('I1', 'Gambar');

        // Ambil data dari tabel detail_sekolah
        $detailData = $this->detail_sekolah->findAll();
        $rowIndex = 2;

        foreach ($detailData as $data) {
            $data = (array) $data; // Konversi object ke array
            $sheet->setCellValue('A' . $rowIndex, $data['det_id']);
            $sheet->setCellValue('B' . $rowIndex, $data['sek_npsn']);
            $sheet->setCellValue('C' . $rowIndex, $data['det_guru']);
            $sheet->setCellValue('D' . $rowIndex, $data['det_siswa_p']);
            $sheet->setCellValue('E' . $rowIndex, $data['det_siswa_l']);
            $sheet->setCellValue('F' . $rowIndex, $data['det_akreditasi']);
            $sheet->setCellValue('G' . $rowIndex, $data['det_kurikulum']);
            $sheet->setCellValue('H' . $rowIndex, $data['det_website'] ?? '-');
            $sheet->setCellValue('I' . $rowIndex, $data['gambar'] ?? null);
            $rowIndex++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Detail_Sekolah_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

}
