<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KamarDipesan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'  => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'pemesanan_id'  => [ 'type'=>'int', 'constraint'=>10,'null'=>false ],
            'kamar_id'  => [ 'type'=>'int','constraint'=>10,'null'=>true ],
            'tarif'  => [ 'type'=>'double', 'constraint'=>11, 'unsigned'=>true, 'null'=>true ],
            'pengguna_id'  => [ 'type'=>'int','constraint'=>11, 'null'=>true ],
            'created_at'  => [ 'type'=>'datetime', 'null'=>true ],
            'updated_at'  => [ 'type'=>'datetime', 'null'=>true ],
        ]); 
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('pemesanan_id','pemesanan','id','cascade','set null');
        $this->forge->addForeignKey('kamar_id','kamar','id','cascade','set null');
        $this->forge->addForeignKey('pengguna_id','pengguna','id','cascade','set null');
        $this->forge->createTable('kamardipesan');

    }

    public function down()
    {
        $this->forge->dropTable('kamardipesan');
    }
}
