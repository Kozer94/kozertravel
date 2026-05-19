<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::firstOrCreate(
            ['email' => 'admin@skyroute.com'],
            [
                'name'     => 'SkyRoute Admin',
                'password' => Hash::make('Admin@2026'),
            ]
        );
    }
}
