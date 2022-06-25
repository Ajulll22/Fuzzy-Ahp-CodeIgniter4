<?php

namespace App\Controllers;

use phpDocumentor\Reflection\PseudoTypes\True_;
use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    public function index()
    {
        $kriteriaModel = new KriteriaModel();
        $data = [
            'title' => "FAHP - Kriteria",
            'head' => "Data Kriteria",
            'kriteria' => $kriteriaModel->get()->getResultArray()
        ];

        return view('kriteria/index', $data);
    }

    public function store()
    {
        $kriteriaModel = new KriteriaModel();
        $kode_kriteria = $this->request->getPost('kode_kriteria');
        $kriteria =$this->request->getPost('kriteria');

        $insert = [
            'kode_kriteria' => $kode_kriteria,
            'kriteria' => $kriteria
            
        ];

        $kriteriaModel->insert_kriteria($insert);

        return redirect()->to('/kriteria'); 
    }

    public function update()
    {
        $kriteriaModel = new KriteriaModel();
        $id = $this->request->getPost('id');
        $kode_kriteria = $this->request->getPost('kode');
        $kriteria =$this->request->getPost('kriteria');

        $update = [
            'kode_kriteria' => $kode_kriteria,
            'kriteria' => $kriteria
        ];

        $kriteriaModel->update_kriteria($update, $id);

        return redirect()->to('/kriteria');
    }
 
    public function delete($id)
    {
        $kriteriaModel = new KriteriaModel();

        $kriteriaModel->delete_kriteria($id);

        return redirect()->to('/kriteria');

    }
 
}
