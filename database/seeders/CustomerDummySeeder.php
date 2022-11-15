<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 1500; $i++) { 
	    	Customer::create([
	            'name' => Str::random(12),
	            'email' => Str::random(12).'@mail.com',
	            'no_telp' => rand(0, 9999999999),
	        ]);
    	}
    }
}
