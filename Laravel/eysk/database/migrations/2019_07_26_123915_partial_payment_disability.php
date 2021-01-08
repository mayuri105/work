<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PartialPaymentDisability extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partial_permanent_disability_sahyognidhi_payments', function (Blueprint $table) {
            $table->bigIncrements('ppdsp_id');
            $table->string('name');
            $table->string('ysk_id');
            $table->decimal('claim_amount', 20,2);
            $table->decimal('given_amount', 20,2);
            $table->decimal('outstanding_amount', 20,2);
            $table->string('claim_person’s_name');
            $table->string('claim_person’s_contact_number');
            $table->text('claim_person’s_address');
            $table->date('given_date');
            $table->date('next_claim_amount_date');
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
        Schema::dropIfExists('partial_permanent_disability_sahyognidhi_payments');
    }
}
