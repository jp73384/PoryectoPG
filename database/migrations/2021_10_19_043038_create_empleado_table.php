<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('idEmpleado');
            $table->string('nombre');
            $table->string('dpi');
            $table->date('nacimiento');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('estadoCivil');
            $table->string('correo')->nullable();
            $table->string('estado');
            $table->unsignedBigInteger('idArea');
            $table->foreign('idArea')->references('idArea')->on('area');
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
        Schema::dropIfExists('empleado');
    }
}
