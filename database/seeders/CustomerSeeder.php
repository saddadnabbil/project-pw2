<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::create([
            'nama' => 'John Doe',
            'email' => 'johndoe@example.com',
            'alamat' => 'Jalan Mawar No. 123',
            'telepon' => '08123456789',
        ]);

        Customer::create([
            'nama' => 'John Doe 1',
            'email' => 'johndoe 1@example.com',
            'alamat' => 'Jalan Mawar No. 123',
            'telepon' => '08123456789',
        ]);
    }
}
