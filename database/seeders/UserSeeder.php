<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'System',
            'email' => 'system@emaxict.com',
            'password' => '1234'
        ]);
        User::factory()->create([
            'name' => 'Webspeed',
            'email' => 'webspeed@naver.com',
            'password' => '1234'
        ]);
    }
}
