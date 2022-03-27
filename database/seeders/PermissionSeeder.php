<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Permission::create(['name' => 'view_user']);
        Permission::create(['name' => 'edit_user']);
        Permission::create(['name' => 'update_user']);
        Permission::create(['name' => 'delete_user']);
        Permission::create(['name' => 'view_role']);
        Permission::create(['name' => 'edit_role']);
        Permission::create(['name' => 'update_role']);
        Permission::create(['name' => 'delete_role']);
        Permission::create(['name' => 'view_product']);
        Permission::create(['name' => 'edit_product']);
        Permission::create(['name' => 'update_product']);
        Permission::create(['name' => 'delete_product']);
    }
}
