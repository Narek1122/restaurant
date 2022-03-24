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
        Schema::create('floor_planes', function (Blueprint $table) {
            $table->id();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->unsignedBigInteger('restaurant_id');
            $table->string('hall_name');
            $table->string('img')->nullable();
            $table->integer('table_x');
            $table->integer('table_y');
            $table->binary('data_json');
            $table->mediumText('description')->nullable();
            $table->timestamps();

            $table->foreign('restaurant_id')
                ->references('id')
                ->on('restaurants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floor_planes');
    }
};
