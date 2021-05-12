<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string ('name')->unique ();
            $table->float ('price');
            $table->float ('quantity');
            $table->date ('added_date');
            $table->integer ('alert')->default (5);
            $table->string ('status', 50)->default ('sufficient');
            $table->foreignId ('category_id')->constrained ('categories');
            $table->foreignId ('brand_id')->constrained ('brands');
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
        Schema::dropIfExists('products');
    }
}
