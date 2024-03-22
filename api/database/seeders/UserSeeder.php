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
        User::factory()->create([
            'name'      => 'Test Admin',
            'email'     => 'admin.test@example.com',
            'role_id'   => 1,
            'client_id' => null
        ]);
    }
}
