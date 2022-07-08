<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Permission::create([
            'name' => 'Chamados',
            'slug' => 'supports'
        ]);
        
        Permission::create([
            'name' => 'Categorias',
            'slug' => 'categories'
        ]);

        Permission::create([
            'name' => 'Localidades',
            'slug' => 'places'
        ]);

        Permission::create([
            'name' => 'Departamentos',
            'slug' => 'departments'
        ]);

        Permission::create([
            'name' => 'Usuários',
            'slug' => 'users'
        ]);

        Permission::create([
            'name' => 'Configurações',
            'slug' => 'settings'
        ]);
    
    }
}
