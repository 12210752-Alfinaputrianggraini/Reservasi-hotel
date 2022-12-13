<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class TamuTest extends CIUnitTestCase{
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'tamu', [
            'nama_depan' => 'Listia',
            'nama_belakang' => 'Priwida',
            'gender' => 'P',
            'alamat' => 'jl.rubini',
            'kota' => 'Singkawang',
            'negara_id' => '1',
            'nohp' => '081234567812',
            'email' => 'priwidal@gmail.com',
            'sandi' => 'testing'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "tamu/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'tamu', [
            'nama_depan' => 'Listia',
            'nama_belakang' => 'Priwida',
            'gender' => 'P',
            'alamat' => 'jl.rubini',
            'kota' => 'Singkawang',
            'negara_id' => '1',
            'nohp' => '081234567812',
            'email' => 'priwidal@gmail.com',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'tamu', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'tamu/all')
                ->assertStatus(200);
    }

}