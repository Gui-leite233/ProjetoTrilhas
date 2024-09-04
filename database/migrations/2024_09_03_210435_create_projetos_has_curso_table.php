<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
       public function up()
    {
        Schema::create('projetos_has_curso', function (Blueprint $table) {
            $table->unsignedBigInteger('projetos_Id');

            $table->foreign('projetos_Id')->references('id')->on('projetos')->onDelete('cascade');

            $table->unsignedBigInteger('cursos_Id');
            $table->foreign('cursos_id')->references('id')->on('cursos')->onDelete('cascade');

            $table->primary(['projetos_id', 'cursos_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('projetos_has_curso');
    }
};
