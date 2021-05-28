<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'muhammad18189@mail.unpad.ac.id',
            'username' => 'mdrfadilah',
            'first_name' => 'Muhammad',
            'last_name' => 'Fadilah',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'email' => 'reza@mail.unpad.ac.id',
            'username' => 'reza123',
            'first_name' => 'Reza',
            'last_name' => 'Attariq',
            'password' => Hash::make('12345678'),
        ]);
    }
}
