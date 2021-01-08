<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModulePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_pages', function (Blueprint $table) {
            $table->increments('page_id');
            $table->integer('fk_module_id');
            $table->integer('parent_page_id')->default(0);
            $table->string('page_title');
            $table->text('page_description');
            $table->string('page_slug');
            $table->string('page_icon');
            $table->string('page_url');
            $table->tinyInteger('is_menu')->comment('0 = No , 1 = Yes')->default(0);
            $table->tinyInteger('status')->comment('0 = InActive, 1 = Active, 2 = Updated, 3 = Deleted')->default(1);
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
        Schema::dropIfExists('module_pages');
    }
}
