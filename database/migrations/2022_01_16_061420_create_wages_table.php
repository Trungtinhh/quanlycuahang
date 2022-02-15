<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wages', function (Blueprint $table) {
            $table->id();
            $table->date('salary_date');
            $table->string('user_name');
            $table->bigInteger('wage_basic')->default(0);
            $table->bigInteger('sales_money')->default(0);
            $table->bigInteger('bonus')->default(0);
            $table->bigInteger('deduct')->default(0);
            $table->bigInteger('wage')->default(0);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('wages');
    }
}
