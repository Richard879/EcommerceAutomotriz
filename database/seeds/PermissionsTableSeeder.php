<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //=========== PERMISO ACCCESO AL MODULO ELEMENTO VENTA ===========
        Permission::create([
            'name'          => 'Acceder al Elemento Venta',
            'slug'          => 'elementoventa.main',
            'description'   => 'Administra el modulo de elementos de venta del sistema',
        ]);
    }
}
