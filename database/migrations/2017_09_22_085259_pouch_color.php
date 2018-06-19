<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PouchColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pouch_color',function(Blueprint $table){
            $table->increments('pouch_color_id');            
            $table->string('product_id');
            $table->string('make_id');
            $table->text('color');
            $table->string('pouch_color_abbr');
            $table->integer('color_value');
            $table->integer('color_category');
            $table->tinyInteger('status'); 
            $table->tinyInteger('is_delete');                    
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
        Schema::drop('pouch_color');
    }
}
