<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            UserRoleSeeder::class,
            RolePermissionSeeder::class,
        ]);
        \App\Models\AddableItem::factory(10)->create();
        \App\Models\NutritionalItem::factory(10)->create();


    }
}
