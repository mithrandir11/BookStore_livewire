<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'user_id' => 1,
            'full_address' => 'تهران زعفرانیه خیابان مقدس اردبیلی پلاک 160',
            'recipient_name' => 'کیارش مقیمی',
            'phone_number' => '09941851798',
            'city' => 'زعفرانیه',
            'state' => 'تهران',
            'postal_code' => '3169188475',
            
        ]);
    }
}
