<?php

namespace App\Controllers;

use phpDocumentor\Reflection\PseudoTypes\True_;
use App\Models\SubkriteriaModel;
use App\Models\KriteriaModel;

class Subkriteria extends BaseController
{
    public function index()
    {
        $subkriteriaModel = new SubkriteriaModel();
        $kriteriaModel = new KriteriaModel();
        $data = [
            'title' => "FAHP - Subkriteria",
            'head' => "Data Subkriteria",
            'subkriteria' => $subkriteriaModel->get_subkriteria()->getResultArray(),
            'kriteria' => $kriteriaModel->get()->getResultArray()
        ];

        return view('subkriteria/index', $data);
    }

    public function store()
    {
        $subkriteriaModel = new SubkriteriaModel();
        $kode_subkriteria = $this->request->getPost('kode_subkriteria');
        $subkriteria =$this->request->getPost('subkriteria');
        $kriteria = $this->request->getPost('kriteria');

        $insert = [
            'kode_subkriteria' => $kode_subkriteria,
            'subkriteria' => $subkriteria,
            'id_kriteria' => $kriteria
            
        ];

        $subkriteriaModel->insert_subkriteria($insert);

        return redirect()->to('/subkriteria'); 
    }

    public function update()
    {
        $subkriteriaModel = new SubkriteriaModel();
        $id = $this->request->getPost('id');
        $kode_subkriteria = $this->request->getPost('kode');
        $subkriteria =$this->request->getPost('subkriteria');
        $kriteria = $this->request->getPost('kriteria');

        $update = [
            'kode_subkriteria' => $kode_subkriteria,
            'subkriteria' => $subkriteria,
            'id_kriteria' => $kriteria
        ];

        $subkriteriaModel->update_subkriteria($update, $id);

        return redirect()->to('/subkriteria');
    }
 
    public function delete($id)
    {
        $subkriteriaModel = new SubkriteriaModel();

        $subkriteriaModel->delete_subkriteria($id);

        return redirect()->to('/subkriteria');

    }
 
}
