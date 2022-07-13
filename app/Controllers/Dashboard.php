<?php

namespace App\Controllers;
use App\Models\SubkriteriaModel;
use App\Models\KriteriaModel;
use App\Models\AlternatifModel;

class Dashboard extends BaseController
{
    public function __construct() 
    {
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new SubkriteriaModel();
        $this->alternatif = new AlternatifModel(); 
    }

    public function index()
    {
        $kriteria = $this->kriteria->get()->getResultArray();
        $subKriteria = $this->subKriteria->get()->getResultArray();
        $alternatif = $this->alternatif->get()->getResultArray();

        $data = [
            'title' => "FAHP - Dashboard",
            'head' => "Dashboard",
            'count_krit' => count($kriteria),
            'count_sub' => count($subKriteria),
            'count_alternatif' => count($alternatif),        
        ];

        return view('dashboard', $data);
    }
}

