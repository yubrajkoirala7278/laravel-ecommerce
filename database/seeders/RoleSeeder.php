<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=['super_admin','admin','user'];
        foreach ($roles as $key => $role) {
            Role::create([
                'name'=>$role
            ]);
        }
    }
}
