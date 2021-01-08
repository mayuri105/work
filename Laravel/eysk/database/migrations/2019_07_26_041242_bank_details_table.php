<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->bigIncrements('bank_detail_id');
            $table->string('bank_name');
            $table->string('bank_account_type');
            $table->string('bank_branch');
            $table->string('bank_account_number');
            $table->string('bank_ifsc_code');
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
        Schema::dropIfExists('bank_details');
    }
}
