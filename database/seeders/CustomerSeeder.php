<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
            [
                'name' => "Coca Cola",
                'since' => "2014-06-28",
                'revenue' => '492.12'
            ],
            [
                'name' => "Teamleader",
                'since' => "2015-01-15",
                'revenue' => '1505.95'
            ],
            [
                'name' => "Jeroen De Wit",
                'since' => "2016-02-11",
                'revenue' => '0.00'
            ],
        ]);
    }
}
