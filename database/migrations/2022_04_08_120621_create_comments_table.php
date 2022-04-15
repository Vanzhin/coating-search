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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->char('sender_email', 75);
            $table->char('sender_name', 50);
            $table->enum('target', ['general', 'product', 'article', 'user'])->default('general');
            $table->unsignedBigInteger('target_id')->default(1);
            $table->unsignedBigInteger('sender_id')->default(1);
            $table->text('message');
            $table->timestamps();
            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('comments');
    }
};
