<?php


use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class kamartarifTest extends CIUnitTestCase{
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamartarif', [
            'kamartipe_id' => 'deluxe',
            'tarif'=> 2000000,
            'tgl_mulai'=>'2022-11-02',
            'tgl_selesai'=>'2022-11-04',
            'tipetarif_id' => 4000000,
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id']> 0);

        $this->call('get', "kamartarif/".$js['id'])
             ->assertStatus(200);

        $this->call('patch', 'kamartarif',[
            'kamartipe_id' => 'deluxe',
            'tarif'=> 2000000,
            'tgl_mulai'=>'2022-11-02',
            'tgl_selesai'=>'2022-11-04',
            'tipetarif_id' => 4000000,
        ])->assertStatus(200);

        $this->call('delete','kamartarif',[
            'id'=>$js ['id']
        ])->assertStatus(200);
    }
    public function testRead(){
        $this->call('get', 'kamartarif/all')
        ->assertStatus(200);
    }
}
