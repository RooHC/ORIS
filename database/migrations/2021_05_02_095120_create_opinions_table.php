<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('presentacion_id');
            $table->tinyInteger('contenido');
            $table->tinyInteger('organizacion');
            $table->tinyInteger('exposicion');
            $table->tinyInteger('tiempo');
            $table->tinyInteger('valoracion');
            $table->text('consejo')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('presentacion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinions');
    }
}
