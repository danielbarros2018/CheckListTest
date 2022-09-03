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
        Schema::create('cake_email', function (Blueprint $table) {
            $table->integer('cake_id')->unsigned();
            $table->integer('email_id')->unsigned();

            $table->unique(['cake_id', 'email_id']);

            $table->foreign('cake_id')
                ->references('id')
                ->on('cakes')
                ->onDelete('cascade');

            $table->foreign('email_id')
                ->references('id')
                ->on('emails')
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
        Schema::dropIfExists('cake_email');
    }
};
