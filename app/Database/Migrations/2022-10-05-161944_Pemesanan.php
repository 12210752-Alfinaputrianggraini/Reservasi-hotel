<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'  => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'kamar_id'  => [ 'type'=>'int', 'constraint'=>10,'null'=>false ],
            'tgl_mulai'  => [ 'type'=>'date','null'=>true ],
            'tgl_selesai'  => [ 'type'=>'date', 'null'=>true ],
            'pemesananstatus_id'  => [ 'type'=>'int','constraint'=>10, 'null'=>true ],
            'tamu_id'  => [ 'type'=>'int','constraint'=>10, 'null'=>true ],
            
        ]); 
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('kamar_id','kamar','id','cascade','set null');
        $this->forge->addForeignKey('pemesananstatus_id','pemesananstatus','id','cascade','set null');
        $this->forge->addForeignKey('tamu_id','tamu','id','cascade','set null');
        $this->forge->createTable('pemesanan');

    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}
