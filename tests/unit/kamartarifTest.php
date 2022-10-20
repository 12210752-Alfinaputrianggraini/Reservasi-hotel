<?php

use App\Database\Migrations\Kamartipe;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class kamartarifTest extends CIUnitTestCase{
    use FeatureTestTrait;
    
    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pengguna', [
            'Kamartipe'=>'01',
            'tarif'=>'1000000',
            'tgl_mulai'=>'01-10-2022',
            'tgl_selesai'=>'03-10-2022',
            'tipetarif'=>'01'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id']> 0);

        $this->call('get', "kamartarif/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'kamartarif',[
            'Kamartipe'=>'01',
            'tarif'=>'1000000',
            'tgl_mulai'=>'01-10-2022',
            'tgl_selesai'=>'03-10-2022',
            'tipetarif'=>'01'
        ])->assertStatus(200);

        $this->call('delete','pengguna',[
            'id' =>$js['id']
        ])->assertStatus(200);
    }
    public function testRead(){
        $this->call('get', 'kamartarif/all')
        ->assertStatus(200);
    }
}
