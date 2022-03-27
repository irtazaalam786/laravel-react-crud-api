<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $permissions = Permission::all()->pluck('name')->toArray();
        $role = Role::create([
            'name'=>'Admin'
        ]);
        $role->syncPermissions($permissions);
    }
}
