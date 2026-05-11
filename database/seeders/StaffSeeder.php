<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff; 
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::create([
            'staff_number' => 1,
            'role_id' => 1, 
            'email' => 'paulray@gmail.com',
            'password' => Hash::make('AdminAccess01'), 
            'first_name' => 'Paul',
            'last_name' => 'Ray',
            'position' => 'Admin',
            'sex' => 'Male',
        ]);
    }
}