<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'id','kode_kriteria', 'kriteria', 'created_at'];

    public function getKriteria(){
        $query = $this->db->query("SELECT * FROM kriteria");
        $row = $query->getRow();

        return $row;
    }


    public function insert_kriteria($data)
    {
        return $this->db->table($this->table)->insert($data);
    } 

    public function update_kriteria($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    } 

    public function delete_kriteria($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    } 
}
