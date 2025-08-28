<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos para préstamos
        Permission::create(['name' => 'view loans']);
        Permission::create(['name' => 'create loans']);
        Permission::create(['name' => 'edit loans']);
        Permission::create(['name' => 'delete loans']);

        // Crear permisos para clientes
        Permission::create(['name' => 'view clients']);
        Permission::create(['name' => 'create clients']);
        Permission::create(['name' => 'edit clients']);
        Permission::create(['name' => 'delete clients']);

        // Crear permisos para usuarios (solo admin)
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Crear permisos para roles (solo admin)
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        //Crear rol admin y asignar todos los permisos
        $adminRol=Role::create(['name'=>'Admin']);
        $adminRol->givePermissionTo(Permission::all());

        //Crear rol user y asignar permisos basicos
        $userRol=Role::create(['name'=>'User']);
        $userRol->givePermissionTo([
            'view loans','create loans','edit loans',
            'view clients', 'create clients', 'edit clients'
        ]);

        //Crear usuario administrador
        $admin=User::create(['email'=>'brayan@gmail.com','password'=>Hash::make('brayan123')]);
        $admin->assignRole('Admin');

        //Crear usuario normal
        $user=User::create([
          'email'=>'user@gmail.com',
          'password'=>Hash::make('user123')
        ]);
        $user->assignRole('User');

        $this->command->info('Roles y permisos creados exitosamente!');
        $this->command->info('Admin: admin@prestamos.com / password123');
        $this->command->info('User: user@prestamos.com / password123');

    }
}
