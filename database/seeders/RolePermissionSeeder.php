<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        for ($i=2; $i < 16; $i++) { 
            DB::table('permission_role')->insert([
                'role_id'=>1,
                'permission_id'=>$i,
            ]);
        }

    }
}