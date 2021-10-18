<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        Users::create(array('email' => 'ritesh.sahu@gmail.com', 'name'=>'Ritesh', 'password'=>Hash::make('123'), 'username'=>'ritesh', 'class_code'=>'2', 'school_code'=>'1'));
        Users::create(array('email' => 'john@gmail.com', 'name'=>'john',  'password'=>Hash::make('123'), 'username'=>'john', 'class_code'=>'3', 'school_code'=>'1'));
    }

}
