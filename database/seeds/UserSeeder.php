<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'ADMIN',
        ]);

        User::create([
            'name' => 'Dicka Estu Saputra',
            'email' => 'dickaestusaputra@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'DONATUR',
        ]);

        User::create([
            'name' => 'Posko Cengkareng',
            'email' => 'poskocengkareng@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'POSKO',
        ]);

        User::create([
            'name' => 'Logistik 1',
            'email' => 'logistik1@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'LOGISTIK',
        ]);
    }
}
