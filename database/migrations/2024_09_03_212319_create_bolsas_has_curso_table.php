<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bolsas_has_curso', function (Blueprint $table) {
            $table->unsignedBigInteger('bolsa_id');
            $table->unsignedBigInteger('curso_id');

            $table->foreign('bolsa_id')->references('id')->on('bolsas')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');

            $table->primary(['bolsa_id', 'curso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bolsas_has_curso');
    }
};
