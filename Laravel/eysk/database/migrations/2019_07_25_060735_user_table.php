<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('fk_role_id');
            $table->string('ysk_id');
            $table->string('family_id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('photo');
            $table->integer('fk_regional_id');
            $table->integer('fk_division_id');
            $table->integer('fk_yuva_mandal_id');
            $table->tinyInteger('first_time_login')->comment('0 = No , 1 = Yes')->default(0);
            $table->string('mac_address');
            $table->tinyInteger('status')->comment('0 = InActive, 1 = Active, 2 = Updated, 3 = Deleted,4=Close Account')->default(1);
            $table->dateTime('account_create_date');
            $table->dateTime('account_close_date');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
