<?php

use Illuminate\Database\Seeder;
use App\User;

class AddUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'DKarpow';
        $admin->email = 'xymerone@gmail.com';
        $admin->role = 10;
        $admin->password = bcrypt('MAtepo7546');
        $admin->save();
    }
}
