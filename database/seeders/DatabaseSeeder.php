<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Bank::create(['name'    => 'SBI']);
        // Bank::create(['name'    => 'ICICI']);
        // Bank::create(['name'    => 'JUPITER FEDERAL']);
        // Bank::create(['name'    => 'IOD']);
        Bank::create(['name'    => 'MONEYVIEW']);
        // Bank::create(['name'    => 'MUTHOOT KOVOOR']);
        // Bank::create(['name'    => 'KERALA BANK KAVUMANNAM']);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
