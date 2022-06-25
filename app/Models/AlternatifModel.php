<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_alternatif', 'alternatif', 'created_at'];

    public function insert_alternatif($data)
    {
        return $this->db->table($this->table)->insert($data);
    } 

    public function update_alternatif($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    } 

    public function delete_alternatif($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    } 
}