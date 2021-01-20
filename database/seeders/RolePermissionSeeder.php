<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        $super_admin = Role::find(1);

        $super_admin->permissions()->sync(Permission::all()->pluck('id'));
        

    }
}
