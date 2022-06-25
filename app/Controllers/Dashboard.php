<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "FAHP - Dashboard",
            'head' => "Dashboard",        
        ];

        return view('dashboard', $data);
    }
}

