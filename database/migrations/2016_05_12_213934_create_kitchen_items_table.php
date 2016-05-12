<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitchenItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_items', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('order_item_id')->unsigned();
            $table->foreign('order_item_id')->references('id')->on('order_items');
            
            $table->foreign('is_completed');
            $table->dateTime('completed_at');
            
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
        Schema::drop('kitchen_items');
    }
}
