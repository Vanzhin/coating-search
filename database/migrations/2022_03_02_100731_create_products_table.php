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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->char('title', 150)->unique();
            $table->text('description');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('catalog_id');
            $table->unsignedTinyInteger('vs');
            $table->unsignedTinyInteger('dft');
            $table->unsignedTinyInteger('dry_to_touch');
            $table->unsignedTinyInteger('dry_to_handle');
            $table->unsignedTinyInteger('min_int');
            $table->unsignedTinyInteger('max_int');
            $table->boolean('tolerance')->default(false);
            $table->unsignedTinyInteger('min_temp');
            $table->unsignedTinyInteger('max_service_temp');
            $table->string('pds')->nullable();
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('catalog_id')
                ->references('id')
                ->on('catalogs')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

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
};
