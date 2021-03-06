<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
        array(
            'name' => 'Admin',
            'username' => 'admin_user',
            'email' => 'themohammeda@outlook.com',
            'password' => bcrypt('admin1'),
            'added_by' => 1                            

        ));

        DB::table('settings')->insert(
        array(
            'company_name' => '',
            'address1' => '',
            'address2' => '',
            'country' => '',                            
            'email' => '',
            'phone' => '',
            'mobile' => '',
            'terms' => '',
            'updated_by' => 1
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->delete();
    }
}
