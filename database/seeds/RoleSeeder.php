<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = Role::create([
        	'name' => 'owner',
        ]);

        $abilities = [];

        for($i = 1; $i <= 42; $i++)
        {
        	$abilities[$i] = $i;
        }

        $record->allowTo($abilities);
    }
}
