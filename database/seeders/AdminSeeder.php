<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => AdminRole::ADMIN_SUPER->value,
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin2025123'),
        ]);
    }
}
