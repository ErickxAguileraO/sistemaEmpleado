<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /* */
    public function up()
    {
        /*tabla tiene elementos id y tiempo en que se genera un registro y campos para crud*/
        /* Crud de empleado con los campos correspondientes*/
        /* id auto ingremental */
        Schema::create('empleados', function (Blueprint $table) {

            $table->id();

            $table->string('nombre');
            $table->string('apellidoPaterno');
            $table->string('apellidoMaterno');
            $table->string('correo');
            $table->string('foto');

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
        Schema::dropIfExists('empleados');
    }
}
