<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipo_partido', function (Blueprint $table) {
            $table->integer('equipo_id');
            $table->integer('partido_id');
            $table->primary(['equipo_id','partido_id']);
            $table->boolean('es_local');
            $table->tinyInteger('goles')->default(0);

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('partido_id')->references('id')->on('partidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_partido');
    }
};
