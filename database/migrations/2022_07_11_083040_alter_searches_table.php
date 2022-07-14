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
        Schema::table('searches', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->default(null)
                ->change();
            $table->dropColumn('status');
            $table->boolean('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('searches', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('is_deleted');
            $table->enum('status', ['active', 'saved', 'deleted'])->default('active');



        });
    }
};
