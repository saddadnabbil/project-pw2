<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'user_id' => 1,
            'nama' => 'John Doe',
            'email' => 'johndoe@example.com',
            'alamat' => 'Jalan Mawar No. 123',
            'telepon' => '08123456789',
        ]);

        Customer::create([
            'user_id' => 2,
            'nama' => 'John Doe 1',
            'email' => 'johndoe 1@example.com',
            'alamat' => 'Jalan Mawar No. 123',
            'telepon' => '08123456789',
        ]);
    }
}
