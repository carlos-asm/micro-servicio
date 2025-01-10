<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionUsersSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for the roles
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'manage recipes']);
        Permission::create(['name' => 'request ingredients']);
        Permission::create(['name' => 'manage inventory']);
        Permission::create(['name' => 'purchase ingredients']);
        Permission::create(['name' => 'view purchase history']);
        Permission::create(['name' => 'view inventory']);
        Permission::create(['name' => 'view recipes']);

        // Create roles and assign permissions
        $gerente = Role::create(['name' => 'gerente']);
        $gerente->givePermissionTo([
            'create orders',
            'view orders',
            'view recipes',
            'view inventory',
            'view purchase history',
        ]);

        $cocina = Role::create(['name' => 'cocina']);
        $cocina->givePermissionTo([
            'manage recipes',
            'request ingredients',
            'view inventory',
        ]);

        $bodega = Role::create(['name' => 'bodega']);
        $bodega->givePermissionTo([
            'manage inventory',
            'purchase ingredients',
            'view purchase history',
        ]);

        // Create demo users and assign roles
        $user1 = \App\Models\User::factory()->create([
            'name' => 'Usuario Gerente',
            'email' => 'gerente@alegra.com',
            'rol' => 'gerente',
            'password' => bcrypt("12345678")
        ]);
        $user1->assignRole($gerente);

        $user2 = \App\Models\User::factory()->create([
            'name' => 'Cocina Usuario',
            'email' => 'cocina@alegra.com',
            'rol' => 'cocina',
            'password' => bcrypt("12345678")
        ]);
        $user2->assignRole($cocina);

        $user3 = \App\Models\User::factory()->create([
            'name' => 'Bodega Usuario',
            'email' => 'bodega@alegra.com',
            'rol' => 'bodega',
            'password' => bcrypt("12345678")
        ]);
        $user3->assignRole($bodega);
    }
}
