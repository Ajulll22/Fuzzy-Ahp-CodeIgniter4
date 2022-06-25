<?php

namespace App\Controllers;

use phpDocumentor\Reflection\PseudoTypes\True_;
use App\Models\AlternatifModel;

class Alternatif extends BaseController
{
    public function index()
    {
        $alternatifModel = new AlternatifModel();
        $data = [
            'title' => "FAHP - Alternatif",
            'head' => "Data Alternatif",
            'alternatif' => $alternatifModel->get()->getResultArray()
        ];

        return view('alternatif/index', $data);
    }

    public function store()
    {
        $alternatifModel = new AlternatifModel();
        $kode_alternatif = $this->request->getPost('kode_alternatif');
        $alternatif =$this->request->getPost('alternatif');

        $insert = [
            'kode_alternatif' => $kode_alternatif,
            'alternatif' => $alternatif
            
        ];

        $alternatifModel->insert_alternatif($insert);

        return redirect()->to('/alternatif'); 
    }

    public function update()
    {
        $alternatifModel = new AlternatifModel();
        $id = $this->request->getPost('id');
        $kode_alternatif = $this->request->getPost('kode');
        $alternatif =$this->request->getPost('alternatif');

        $update = [
            'kode_alternatif' => $kode_alternatif,
            'alternatif' => $alternatif
        ];

        $alternatifModel->update_alternatif($update, $id);

        return redirect()->to('/alternatif');
    }
 
    public function delete($id)
    {
        $alternatifModel = new AlternatifModel();

        $alternatifModel->delete_alternatif($id);

        return redirect()->to('/alternatif');

    }
 
}
