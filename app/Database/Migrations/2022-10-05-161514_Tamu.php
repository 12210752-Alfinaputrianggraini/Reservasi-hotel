<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tamu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'  => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama_depan'  => [ 'type'=>'varchar', 'constraint'=>50,'null'=>false ],
            'nama_belakang'  => [ 'type'=>'varchar', 'constraint'=>50,'null'=>true ],
            'gender'  => [ 'type'=>'enum("L","P")', 'null'=>true ],
            'alamat'  => [ 'type'=>'varchar', 'constraint'=>250, 'null'=>true ],
            'kota'  => [ 'type'=>'varchar', 'constraint'=>50, 'null'=>true ],
            'negara_id'  => [ 'type'=>'int','constraint'=>10, 'null'=>true ],
            'nohp'  => [ 'type'=>'varchar', 'constraint'=>16, 'null'=>true ],
            'email'  => [ 'type'=>'varchar', 'constraint'=>255, 'null'=>true ],
            'sandi'  => [ 'type'=>'varchar', 'constraint'=>60, 'null'=>true ],
            'token_reset'  => [ 'type'=>'varchar', 'constraint'=>10, 'null'=>true ],
            'created_at'  => [ 'type'=>'datetime', 'null'=>true ],
            'updated_at'  => [ 'type'=>'datetime', 'null'=>true ],
            'deleted_at'  => [ 'type'=>'datetime', 'null'=>true ],   
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('negara_id','negara','id','cascade','set null');
        $this->forge->createTable('tamu');
    }

    public function down()
    {
        $this->forge->dropTable('tamu');
    }
}
