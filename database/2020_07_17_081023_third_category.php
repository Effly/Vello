<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ThirdCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_category', function(Blueprint $table){
            $table->increments('id');
            $table->integer('scnd_cat_id')->unsigned()->default(0);
            $table->foreign('scnd_cat_id')
                ->references('id')->on('second_category')
                ->onDelete('cascade');
            $table->string('name_third');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('third_category');
    }
}
