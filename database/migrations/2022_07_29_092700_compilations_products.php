<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compilations_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compilation_id');
            $table->foreign('compilation_id')
                ->references('id')
                ->on('compilations')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists('compilations_products');

    }
};
