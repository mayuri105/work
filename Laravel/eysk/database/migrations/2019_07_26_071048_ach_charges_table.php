<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AchChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ach_charges', function (Blueprint $table) {
            $table->bigIncrements('ach_charge_id');
            $table->decimal('ach_charges_amount', 20,2);
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('ach_charges');
    }
}
