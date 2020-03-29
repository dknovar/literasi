<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'  => 'kadeksatya',
            'username' => 'admin',
            'password'  => bcrypt('secret'),
            'role' => 'admin'
    ]);

    
    }
}
