<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('saler_id')->unsigned();
            $table->foreign('saler_id')->references('id')->on('salers');
            $table->bigInteger('buyer_id')->unsigned();
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('staff');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');          
            $table->integer('product_amount');
            $table->string('product_unit')->nullable();
            $table->bigInteger('price_id')->unsigned();
            $table->foreign('price_id')->references('price_id')->on('prices');
            $table->dateTime('date_create')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('invoices');
    }
}