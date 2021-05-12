<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_card', function (Blueprint $table) {
            $table->id();
            $table->string ('product_name');
            $table->float ('product_price');
            $table->float ('product_quantity');
            $table->bigInteger ('product_id');
            $table->string ('status', 50)->nullable();
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
        Schema::dropIfExists('stock_card');
    }
}
