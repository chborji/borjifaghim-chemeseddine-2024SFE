<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitComposeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_composes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image', 30)->nullable();
            $table->decimal('price')->default(0);
            $table->integer('requis')->nullable();
            $table->string('ingredients')->nullable();

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
        Schema::dropIfExists('produit_compose');
    }
}
