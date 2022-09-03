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
        Schema::create('cakes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 80)->nullable(false);
            $table->unique(['nome']);
            $table->integer('peso');
            $table->float('valor', 8,2);
            $table->integer('quantidade');
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
        Schema::dropIfExists('cakes');
    }
};
