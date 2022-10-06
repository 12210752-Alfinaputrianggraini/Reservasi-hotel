<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemesananstatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'  => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true ],
            'status'  => [ 'type'=>'varchar', 'constraint'=>50,'null'=>false ],
            'urutan'  => [ 'type'=>'int', 'constraint'=>11,'unsigned'=>true, 'null'=>false ],
            'aktif'  => [ 'type'=>'enum("Y","T")', 'null'=>true ],
        ]); 
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pemesananstatus'); 
    }

    public function down()
    {
        $this->forge->dropTable('pemesananstatus');
    }
}
