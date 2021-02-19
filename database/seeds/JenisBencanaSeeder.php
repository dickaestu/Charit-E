<?php

use App\AdminModel\JenisBencana;
use Illuminate\Database\Seeder;

class JenisBencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisBencana::create([
            'id_jenis_bencana' => 1,
            'nama_bencana' => 'Gempa Bumi',
        ]);
        JenisBencana::create([
            'id_jenis_bencana' => 2,
            'nama_bencana' => 'Kebakaran',
        ]);
        JenisBencana::create([
            'id_jenis_bencana' => 3,
            'nama_bencana' => 'Banjir',
        ]);
    }
}
