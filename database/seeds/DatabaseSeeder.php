<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'muhammad nurhadi aldo',
            'email' => 'nurhadialdo.celebgramme@gmail.com',
            'username' => 'nurhadi',
            'password' => bcrypt('dantemustdie'),
            'gender'=> 1, //male
            'point' => 0,
            'is_admin' => 1, //admin
            'is_confirm' => 1,
            'confirm_code' => null,
            'last_login' => null, 
            'referral_link' => null,
            'remember_token'=>null,
          ]);

          DB::table('users')->insert([
            'name'=>'muhammad jati',
            'email'=>'jatigembala@gmail.com',
            'username'=>'jati raya',
            'password'=>bcrypt('areyouhappy'),
            'gender'=>0, //female
            'point'=>0,
            'is_admin'=>1,//admin
            'is_confirm'=>1,
            'confirm_code'=>null,
            'last_login'=>null,
            'referral_link'=>null,
            'remember_token'=>null,
          ]);
          DB::table('users')->insert([
            'name' => 'ciquutitta',
            'email' => 'tita.celebgramme@gmail.com',
            'username' => 'titta123',
            'password' => bcrypt('dantemustdie'),
            'gender'=> 0, //female
            'point' => 0,
            'is_admin' => 0, //user
            'is_confirm' => 1,
            'confirm_code' => null,
            'last_login' => null, 
            'referral_link' => null,
            'remember_token'=>null,
          ]);

          DB::table('users')->insert([
            'name'=>'daniel lopez',
            'email'=>'danielgembala@gmail.com',
            'username'=>'daniel1136123',
            'password'=>bcrypt('noamnot'),
            'gender'=>1, //male
            'point'=>0,
            'is_admin'=>0,//user
            'is_confirm'=>1,
            'confirm_code'=>null,
            'last_login'=>null,
            'referral_link'=>null,
            'remember_token'=>null,
          ]);
    }
}
