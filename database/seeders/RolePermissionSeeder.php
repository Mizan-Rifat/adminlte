<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // for ($i=1; $i < 16; $i++) { 
        //     DB::table('permission_role')->insert([
        //         'role_id'=>1,
        //         'permission_id'=>$i,
        //     ]);
        // }
        $super_admin = Role::find(1);

        $super_admin->permissions()->sync(Permission::all()->pluck('id'));
        

    }
}
