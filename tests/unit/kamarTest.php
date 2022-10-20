<?php

use App\Database\Migrations\Kamar;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class kamarTest extends CIUnitTestCase{
    use FeatureTestTrait;
    
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamar', [
            'lantai'=>'01',
            'nomor'=>'100',
            'deskripsi'=>'01102022',
            'aktif'=>'Y',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id']> 0);

        $this->call('get', "kamar/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'kamar',[
            'status'=>'siap huni',
            'keterangan'=>'2 orang',
            'urutan'=>'01102022',
            'aktif'=>'Y',
        ])->assertStatus(200);

        $this->call('delete','kamar',[
            'id' =>$js['id']
        ])->assertStatus(200);
    }
    public function testRead(){
        $this->call('get', 'kamar/all')
        ->assertStatus(200);
    }
}
