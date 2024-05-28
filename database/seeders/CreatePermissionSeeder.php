<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CreatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => "bw:auth:permission:add", 'guard_name' => 'web']);
        Permission::create(['name' => "bw:auth:role:add", 'guard_name' => 'web']);
    }
}
