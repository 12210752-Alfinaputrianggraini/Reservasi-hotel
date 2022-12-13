<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class KamartarifTest extends CIUnitTestCase{
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamartarif', [
            'kamartipe_id' => '1',
            'tarif' => 2000000,
            'tgl_mulai' => '2022-11-02',
            'tgl_selesai' => '2022-11-05',
            'tipetarif_id' => '1',
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "kamartarif/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'kamartarif', [
            'kamartipe_id' => '1',
            'tarif' => 2000000,
            'tgl_mulai' => '2022-11-02',
            'tgl_selesai' => '2022-11-05',
            'tipetarif_id' => '1',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kamartarif', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'kamartarif/all')
                ->assertStatus(200);
    }

}