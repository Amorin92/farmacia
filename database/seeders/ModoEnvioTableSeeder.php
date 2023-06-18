<?php

use Illuminate\Database\Seeder;
use App\Models\ModoEnvio;

class ModoEnvioTableSeeder extends Seeder
{
    public function run()
    {
        $modoenvio = [
            ['nome' => 'Aéreo'],
            ['nome' => 'Rodoviário'],
            ['nome' => 'Hidroviário'],
            ['nome' => 'Ferroviário'],
            ['nome' => 'Híbrido'],
        ];

        foreach ($modoenvio as $modoenvio) {
            ModoEnvio::create($modoenvio);
        }
    }
}
