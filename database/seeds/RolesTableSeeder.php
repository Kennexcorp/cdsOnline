<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::create([
            'name' => 'Admin'
        ]);
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        $role = Role::create([
            'name' => 'Supervisor'
        ]);
        $permissions = [
            
        ];
        $role->syncPermissions($permissions);

        $role = Role::create([
            'name' => 'Official'
        ]);
        $permissions = [
            
        ];
        $role->syncPermissions($permissions);

        $role = Role::create([
            'name' => 'Member'
        ]);
        $permissions = [
            
        ];
        $role->syncPermissions($permissions);


    }
}
