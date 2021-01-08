<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RePaymentDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('re_payment_dates', function (Blueprint $table) {
            $table->bigIncrements('re_payment_date_id');
            $table->date('re_payment_date');
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
        Schema::dropIfExists('re_payment_dates');
    }
}
