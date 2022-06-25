<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subkriteria extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kriteria'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'kode_subkriteria'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'subkriteria' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id');
        $this->forge->createTable('subkriteria');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('subkriteria');
    }
}
