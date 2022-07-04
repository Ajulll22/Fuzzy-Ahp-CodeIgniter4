<?php

namespace App\Controllers;
use App\Models\SubkriteriaModel;
use App\Models\KriteriaModel;
use App\Models\AlternatifModel;

class Hitung extends BaseController
{
    public function __construct() {
 
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new SubkriteriaModel();
        $this->alternatif = new AlternatifModel(); 
        }

    public function index()
    {
        $subkriteria = $this->subKriteria->get_subkriteria()->getResultArray();

        $countIdKriteria = [];
        foreach($subkriteria as $sub) {
            if(!array_key_exists($sub['id_kriteria'], $countIdKriteria)){
                $countIdKriteria[$sub['id_kriteria']] = 1;
            } else {
                $countIdKriteria[$sub['id_kriteria']] += 1;
            }
        }

        $data = [
            'title' => "FAHP - Hasil Perhitungan",
            'head' => "Hasil Perhitungan",
            'kriteria' => $this->kriteria->get()->getResultArray(),
            'subkriteria' => $subkriteria,
            'alternatif' => $this->alternatif->get()->getResultArray(),
            'totalSub' => $countIdKriteria,
        ];
        return view('hitung/index', $data);
    }

    public function fuzzy_matrix(){
        $matrix = array(
            array(1, 2, 3, 4),
            array(0.5, 1, 5, 6),
            array(0.33, 0.2, 1, 2),
            array(0.25, 0.16, 0.5, 1)
        );
    }

    public function matrix(){
        // dd((int)$this->request->getPost('0_0'));

        $kriteria = $this->kriteria->get()->getResultArray();
        $matrix = $this->request->getPost();
        for ($k = 0; $k<count($kriteria); $k++){
            $k_[$k] = array();
        }

        for ($j = 0; $j<count($kriteria); $j++){
            for ($i = 0; $i<count($kriteria); $i++){
                $value = (float)$matrix[$i.'_'.$j];

                if( $value == 1 ){
                    array_push($k_[$j],array(1,1,1));
                }elseif( ($value == 2) || ($value == 4) || ($value == 6) || ($value == 8) ){
                    array_push($k_[$j],array(($value-1)/2,$value/2,($value+1)/2));
                }elseif( ($value == 3) || ($value == 5) || ($value == 7) ){
                    array_push($k_[$j],array(floor($value/2),$value/2,ceil($value/2)));
                }elseif( ($value == 9) ){
                    array_push($k_[$j],array(4, 4.5, 4.5));
                }elseif( (round($value, 2) == 0.5) ){
                    array_push($k_[$j],array(2/3, 1, 2));
                }elseif( (round($value, 2) == 0.25) ){
                    array_push($k_[$j],array(0.4, 0.5, 2/3));
                }elseif( (round($value, 2) == 0.17) ){
                    array_push($k_[$j],array(2/7, 1/3, 2/5));
                }elseif( (round($value, 3) == 0.125) ){
                    array_push($k_[$j],array(2/9, 0.25, 2/7));
                }elseif( (round($value, 2) == 0.33) ){
                    array_push($k_[$j],array(0.5, 2/3, 1));
                }elseif( (round($value, 2) == 0.2) ){
                    array_push($k_[$j],array(1/3, 0.4, 0.5));
                }elseif( (round($value, 2) == 0.14) ){
                    array_push($k_[$j],array(0.25, 2/7, 1/3));
                }elseif( (round($value, 2) == 0.11) ){
                    array_push($k_[$j],array(2/9, 2/9, 0.25));
                }else {
                    array_push($k_[$j],array(0, 0, 0));
                }
                // array_push($k_[$j],array(1,1,1));
            }
        }
        $jumlah = array();
        
        for ($x = 0; $x<count($kriteria); $x++){
            $lower = 0;
            $medium = 0;
            $upper = 0;
            $z=0;
            for ($l = 0; $l<count($kriteria); $l++){
                $lower = $lower + $k_[$l][$x][$z];
            }
            $z++;
            for ($m = 0; $m<count($kriteria); $m++){
                $medium = $medium + $k_[$m][$x][$z];
            }
            $z++;
            for ($u = 0; $u<count($kriteria); $u++){
                $upper = $upper + $k_[$u][$x][$z];
            }
            array_push($jumlah, array($lower, $medium, $upper));
        }

        $invers_jumlah = array();
        $lower_inv = 0;
        $medium_inv = 0;
        $upper_inv = 0;
        for ($i = 0; $i<count($jumlah); $i++){
            $lower_inv = $lower_inv + $jumlah[$i][0] ;
        }
        for ($i = 0; $i<count($jumlah); $i++){
            $medium_inv = $medium_inv + $jumlah[$i][1] ;
        }
        for ($i = 0; $i<count($jumlah); $i++){
            $upper_inv = $upper_inv + $jumlah[$i][2] ;
        }

        array_push($invers_jumlah, 1/$upper_inv, 1/$medium_inv, 1/$lower_inv);

        $sintesis = array();

        for ($x = 0; $x<count($jumlah); $x++){
            $lower_sint = 0;
            $medium_sint = 0;
            $upper_sint = 0;
            
            $lower_sint = $jumlah[$x][0] * $invers_jumlah[0];
            $medium_sint = $jumlah[$x][1] * $invers_jumlah[1];
            $upper_sint = $jumlah[$x][2] * $invers_jumlah[2];

            array_push($sintesis, array($lower_sint, $medium_sint, $upper_sint));
        }
        
        for ($v = 0; $v<count($kriteria); $v++){
            $v_[$v] = array();
        }
        for($m2=0; $m2<count($sintesis); $m2++){
            $vector = array();

            for($m1=0; $m1<count($sintesis); $m1++){
                if ($m2 == $m1) {
                    continue;
                }else {
                    if ($sintesis[$m2][1] >= $sintesis[$m1][1] ) {
                        array_push($vector, 1);
                    }elseif ($sintesis[$m2][2] <= $sintesis[$m1][0] ) {
                        array_push($vector, 0);
                    }else {
                        $lain = ($sintesis[$m1][0] - $sintesis[$m2][2]) / (($sintesis[$m2][1] - $sintesis[$m2][2]) - ($sintesis[$m1][1]-$sintesis[$m1][0]));
                        array_push($vector, $lain);
                    }
                }
            }
             array_push($v_[$m2], min($vector));
        }
        $sum_v = 0;
        for($v = 0; $v<count($v_); $v++){
            $sum_v = $sum_v + $v_[$v][0];
        }

        $normalisasi = array();
        for( $i=0 ; $i<count($v_) ; $i++ ){
            array_push($normalisasi, $v_[$i][0] / $sum_v);
        }

        $subkriteria = $this->subKriteria->get_subkriteria()->getResultArray();

        $countIdKriteria = [];
        foreach($subkriteria as $sub) {
            if(!array_key_exists($sub['id_kriteria'], $countIdKriteria)){
                $countIdKriteria[$sub['id_kriteria']] = 1;
            } else {
                $countIdKriteria[$sub['id_kriteria']] += 1;
            }
        }

        $data = [
            'subkriteria' => $subkriteria,
            'totalSub' => $countIdKriteria
        ];

        $view = view('hitung/sub', $data);

        // echo $view;
        // echo json_encode($normalisasi);
        echo json_encode( array('view'=>$view, 'kriteria'=>$normalisasi) );
    }

    public function matrix_sub(){
        $subkriteria = $this->subKriteria->get_subkriteria()->getResultArray();

        $countIdKriteria = [];
        foreach($subkriteria as $sub) {
            if(!array_key_exists($sub['id_kriteria'], $countIdKriteria)){
                $countIdKriteria[$sub['id_kriteria']] = 1;
            } else {
                $countIdKriteria[$sub['id_kriteria']] += 1;
            }
        }
        $matrix = $this->request->getPost();
        $sub = array_values($countIdKriteria);
        $index = 0 ;
        $hasil_sub = array();
        foreach($sub as $totsub){
            // $totsub = 3;
            $k_ = array();
    
            for ($j = 0; $j<$totsub; $j++){
                $temp = array();
                for ($i = 0; $i<$totsub; $i++){
                    // $index = 1;
                    $value = (float)$matrix[$index.'_'.$i.'_'.$j];
    
                    if( $value == 1 ){
                        array_push($temp,array(1,1,1));
                    }elseif( ($value == 2) || ($value == 4) || ($value == 6) || ($value == 8) ){
                        array_push($temp,array(($value-1)/2,$value/2,($value+1)/2));
                    }elseif( ($value == 3) || ($value == 5) || ($value == 7) ){
                        array_push($temp,array(floor($value/2),$value/2,ceil($value/2)));
                    }elseif( ($value == 9) ){
                        array_push($temp,array(4, 4.5, 4.5));
                    }elseif( (round($value, 2) == 0.5) ){
                        array_push($temp,array(2/3, 1, 2));
                    }elseif( (round($value, 2) == 0.25) ){
                        array_push($temp,array(0.4, 0.5, 2/3));
                    }elseif( (round($value, 2) == 0.17) ){
                        array_push($temp,array(2/7, 1/3, 2/5));
                    }elseif( (round($value, 3) == 0.125) ){
                        array_push($temp,array(2/9, 0.25, 2/7));
                    }elseif( (round($value, 2) == 0.33) ){
                        array_push($temp,array(0.5, 2/3, 1));
                    }elseif( (round($value, 2) == 0.2) ){
                        array_push($temp,array(1/3, 0.4, 0.5));
                    }elseif( (round($value, 2) == 0.14) ){
                        array_push($temp,array(0.25, 2/7, 1/3));
                    }elseif( (round($value, 2) == 0.11) ){
                        array_push($temp,array(2/9, 2/9, 0.25));
                    }else {
                        array_push($temp,array(0, 0, 0));
                    }
                    // array_push($k_[$j],array(1,1,1));
                }

                array_push($k_, $temp);
                
            }

            $jumlah = array();
        
            for ($x = 0; $x<$totsub; $x++){
                $lower = 0;
                $medium = 0;
                $upper = 0;
                $z=0;
                for ($l = 0; $l<$totsub; $l++){
                    $lower = $lower + $k_[$l][$x][$z];
                }
                $z++;
                for ($m = 0; $m<$totsub; $m++){
                    $medium = $medium + $k_[$m][$x][$z];
                }
                $z++;
                for ($u = 0; $u<$totsub; $u++){
                    $upper = $upper + $k_[$u][$x][$z];
                }
                array_push($jumlah, array($lower, $medium, $upper));
            }

            $invers_jumlah = array();
            $lower_inv = 0;
            $medium_inv = 0;
            $upper_inv = 0;
            for ($i = 0; $i<count($jumlah); $i++){
                $lower_inv = $lower_inv + $jumlah[$i][0] ;
            }
            for ($i = 0; $i<count($jumlah); $i++){
                $medium_inv = $medium_inv + $jumlah[$i][1] ;
            }
            for ($i = 0; $i<count($jumlah); $i++){
                $upper_inv = $upper_inv + $jumlah[$i][2] ;
            }

            array_push($invers_jumlah, 1/$upper_inv, 1/$medium_inv, 1/$lower_inv);

            $sintesis = array();

            for ($x = 0; $x<count($jumlah); $x++){
                $lower_sint = 0;
                $medium_sint = 0;
                $upper_sint = 0;
                
                $lower_sint = $jumlah[$x][0] * $invers_jumlah[0];
                $medium_sint = $jumlah[$x][1] * $invers_jumlah[1];
                $upper_sint = $jumlah[$x][2] * $invers_jumlah[2];

                array_push($sintesis, array($lower_sint, $medium_sint, $upper_sint));
            }

            $v_ = array();
            for($m2=0; $m2<count($sintesis); $m2++){
                $vector = array();
    
                for($m1=0; $m1<count($sintesis); $m1++){
                    if ($m2 == $m1) {
                        continue;
                    }else {
                        if ($sintesis[$m2][1] >= $sintesis[$m1][1] ) {
                            array_push($vector, 1);
                        }elseif ($sintesis[$m2][2] <= $sintesis[$m1][0] ) {
                            array_push($vector, 0);
                        }else {
                            $lain = ($sintesis[$m1][0] - $sintesis[$m2][2]) / (($sintesis[$m2][1] - $sintesis[$m2][2]) - ($sintesis[$m1][1]-$sintesis[$m1][0]));
                            array_push($vector, $lain);
                        }
                    }
                }
                $temp=array();
                 array_push($temp, min($vector));
                 array_push($v_, $temp);
            }
            $sum_v = 0;
            for($v = 0; $v<count($v_); $v++){
                $sum_v = $sum_v + $v_[$v][0];
            }

            $normalisasi = array();
            for( $i=0 ; $i<count($v_) ; $i++ ){
                array_push($normalisasi, $v_[$i][0] / $sum_v);
            }

            // dd($normalisasi);
            $index = $index + 1 ;
            array_push($hasil_sub, $normalisasi);
        }

        $subkriteria = $this->subKriteria->get_subkriteria()->getResultArray();

        $countIdKriteria = [];
        foreach($subkriteria as $sub) {
            if(!array_key_exists($sub['id_kriteria'], $countIdKriteria)){
                $countIdKriteria[$sub['id_kriteria']] = 1;
            } else {
                $countIdKriteria[$sub['id_kriteria']] += 1;
            }
        }

        $data = [
            'subkriteria' => $subkriteria,
            'alternatif' => $this->alternatif->get()->getResultArray(),
            'totalSub' => $countIdKriteria,
        ];

        $view = view('hitung/alternatif', $data);

        echo json_encode( array('view'=>$view, 'hasil_sub'=>$hasil_sub, 'hasil_krit'=>$matrix['hasil_kriteria']) );
        
    }

    
    public function hasil_akhir(){
        $post = $this->request->getPost();

        $hasil_sub = json_decode($post['hasil_sub']);
        $hasil_krit = json_decode($post['hasil_krit']);

        $subkriteria = $this->subKriteria->get_subkriteria()->getResultArray();

        $countIdKriteria = [];
        foreach($subkriteria as $sub) {
            if(!array_key_exists($sub['id_kriteria'], $countIdKriteria)){
                $countIdKriteria[$sub['id_kriteria']] = 1;
            } else {
                $countIdKriteria[$sub['id_kriteria']] += 1;
            }
        }

        $alternatif = $this->alternatif->get()->getResultArray();

        $sub = array_values($countIdKriteria);
        $index = 0 ;
        $hasil_akhir_sub = array();
        $coba = array();

        foreach($sub as $totsub){

            $per_krit = array();

            for($i=0;$i<$totsub;$i++){

                $row = array();

                for($j=0;$j<count($alternatif);$j++){

                    $value = (float)$post[$index.'_'.$i.'_'.$j];

                    $temp_hasil = $value * $hasil_sub[$index][$i] * $hasil_krit[$index];
                    array_push($row, $temp_hasil);
                }
                array_push($per_krit, $row);

            }
            $jumlah_krit = array();
            for($h=0;$h<count($alternatif);$h++){
                $arrSum = array_sum(array_column($per_krit, $h));

                array_push($jumlah_krit, $arrSum);
            }
            // dd($per_krit);
            array_push($coba, $per_krit);

            
            array_push($hasil_akhir_sub, $jumlah_krit);

            $index++;
        }

        $jumlah_akhir = array();

        for($g=0;$g<count($alternatif);$g++){
            $sum_akhir = array_sum(array_column($hasil_akhir_sub, $g));

            array_push($jumlah_akhir, $sum_akhir);
        }
        $no = 0 ;
        $data_akhir = array();
        foreach ($alternatif as $value) {
            
            // array_push($value, 'hasil' => $jumlah_akhir[$no]);
            $value['hasil'] = $jumlah_akhir[$no];

            // dd($value);
            array_push($data_akhir, $value);

            $no++;
        }


        // dd($data_akhir);

        $sortColumn = ['hasil'];
        foreach($sortColumn as $column){
        usort($data_akhir, function($a, $b) use ($column){
            return $a[$column] < $b[$column];
        });  
        }

        $data = [
            'title' => "FAHP - Kriteria",
            'head' => "Data Kriteria",
            'alternatif' => $data_akhir
        ];

        return view('hitung/hasilakhir', $data);

    }


    public function test(){
        $data = [
            'title' => "FAHP - Kriteria",
            'head' => "Data Kriteria",
        ];

        return view('hitung/hasilakhir', $data);
    }

}

