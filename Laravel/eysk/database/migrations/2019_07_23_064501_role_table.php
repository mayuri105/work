<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->string('name');
            $table->tinyInteger('role_type')->comment('1 = CEO, 2 = YSK Team Top 10,3 = Office Main,4 = Office Team,5 = Web backend,6 = YSK ID / Member')->default(1);
            $table->tinyInteger('status')->comment('0 = InActive, 1 = Active, 2 = Updated, 3 = Deleted')->default(1);
            $table->string('role_slug');
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
        Schema::dropIfExists('roles');
    }
}
