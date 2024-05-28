<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'label' => 'Admin','guard_name' => 'web']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@bawon.co.id',
            'password' => Hash::make('rahasia'),
        ]);

        $user->assignRole('admin');
    }
}
