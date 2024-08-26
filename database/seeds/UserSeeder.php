<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = User::create([
        	'name' 	   => 'Eslam Hany',
        	'email'    => 'eslamhani@gmail.com',
        	'password' => Hash::make('123456789'),
        	'status'   => 'active', 
        ]);

        $record->assignRole([1]);
    }
}
