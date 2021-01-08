<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class YuvaMandalNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yuva_mandal_numbers', function (Blueprint $table) {
            $table->bigIncrements('yuva_mandal_number_id');
            $table->string('yuva_mandal_number');
            $table->tinyInteger('status')->comment('0 = InActive, 1 = Active, 2 = Updated, 3 = Deleted')->default(1);
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
        Schema::dropIfExists('yuva_mandal_numbers');
    }
}
