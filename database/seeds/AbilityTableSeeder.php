<?php

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abilities = [
        	'products_list',
        	'products_create',
        	'products_update',
        	'products_delete',
        	'products_show',

        	'departments_list',
        	'departments_create',
        	'departments_update',
        	'departments_delete',

        	'trademarks_list',
        	'trademarks_create',
        	'trademarks_update',
        	'trademarks_delete',

        	'colors_list',
        	'colors_create',
        	'colors_update',
        	'colors_delete',

        	'governorates_list',
        	'governorates_create',
        	'governorates_update',
        	'governorates_delete',

        	'users_list',
        	'users_create',
        	'users_update',
        	'users_delete',

        	'roles_list',
        	'roles_create',
        	'roles_update',
        	'roles_delete',

        	'orders_list',
        	'orders_create',
        	'orders_update',
        	'orders_delete',

        	'invoices_list',
        	'invoices_paidlist',
        	'invoices_unpaidlist',
        	'invoices_archivelist',
        	'invoices_update',
        	'invoices_delete',
        	'invoices_archive',
            'invoices_print',
            'invoices_excel',
        ];

        foreach($abilities as $ability)
        {
        	Ability::create(['name' => $ability]);
        }
    }
}
