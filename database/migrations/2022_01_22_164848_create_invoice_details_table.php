<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('user_name');
            $table->string('product_name');
            $table->integer('price_cost');
            $table->double('total')->default(0);
            $table->double('submoney')->default(0);
            $table->double('tax')->default(0);
            $table->bigInteger('promotion_id')->unsigned()->nullable();
            $table->foreign('quantity_promotion')->references('id')->on('promotions')->onDelete('cascade');
            $table->bigInteger('quantity_promotion')->nullable();
            $table->dateTime('date_create')->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
}