<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string ('customer_name');
            $table->date ('added_date');
            $table->float ('sub_total');
            $table->float ('tva');
            $table->float ('discount');
            $table->float ('workforce');
            $table->float ('net_total');
            $table->float ('paid');
            $table->float ('due');
            $table->string ('payment_type')->default('Cash');
            $table->string ('currency')->default('USD');
            $table->string ('amount_in_letters')->default('Montant en lettres');
            $table->longText ('designation');
            $table->string ('status', 50)->default('not_paid');
            $table->string ('order_number')->unique ()->nullable();
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
        Schema::dropIfExists('orders');
    }
}
