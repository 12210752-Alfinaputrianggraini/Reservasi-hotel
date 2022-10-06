<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'  => [ 'type'=>'int', 'constraint'=>10, 'unsigned'=>true, 'auto_increment'=>true ],
            'nama_depan'  => [ 'type'=>'varchar', 'constraint'=>50,'null'=>false ],
            'nama_belakang'  => [ 'type'=>'varchar', 'constraint'=>50,'null'=>true ],
            'gender'  => [ 'type'=>'enum("L","P")', 'null'=>true ],
            'alamat'  => [ 'type'=>'varchar', 'constraint'=>255, 'null'=>true ],
            'kota'  => [ 'type'=>'varchar', 'constraint'=>50, 'null'=>true ],
            'tgl_lhr'  => [ 'type'=>'date', 'null'=>true ],
            'notelp'  => [ 'type'=>'varchar', 'constraint'=>16, 'null'=>true ],
            'nohp'  => [ 'type'=>'varchar', 'constraint'=>16, 'null'=>true ],
            'email'  => [ 'type'=>'varchar', 'constraint'=>128, 'null'=>true ],
            'level'  => [ 'type'=>'enum("M","R","B")', 'null'=>true ],
            'foto'  => [ 'type'=>'varchar', 'constraint'=>225, 'null'=>true ],
            'sandi'  => [ 'type'=>'varchar', 'constraint'=>60, 'null'=>true ],
            'token_reset'  => [ 'type'=>'varchar', 'constraint'=>10, 'null'=>true ],
            'created_at'  => [ 'type'=>'datetime', 'null'=>true ],
            'updated_at'  => [ 'type'=>'datetime', 'null'=>true ],
            'deleted_at'  => [ 'type'=>'datetime', 'null'=>true ],   
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pengguna');

    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
