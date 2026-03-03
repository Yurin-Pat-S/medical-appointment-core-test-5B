<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurar que el rol 'Doctor' existe antes de asignarlo
        $doctorRole = Role::firstOrCreate(['name' => 'Doctor']);
        
        $user = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Yurin Pat',
                'password' => bcrypt('123456'),
                'id_number' => '1234567890',
                'phone' => '9999016527',
                'address' => 'Calle 101, colonia 1 ',
            ]
        );
        
        // Asignar el rol (sincronizar para asegurar que solo tenga este rol)
        $user->syncRoles([$doctorRole->name]);
    }
}
