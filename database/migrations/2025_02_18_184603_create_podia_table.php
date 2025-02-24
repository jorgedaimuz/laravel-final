<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('podiums', function (Blueprint $table) {
            $table->id();
            // Agrega una columna para el ID del usuario, asumiendo que la tabla de usuarios es 'users'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Una columna para almacenar el puntaje (número de aciertos, de 0 a 10)
            $table->unsignedTinyInteger('score');
            // Si deseas guardar más detalles, puedes agregar una columna de tipo JSON, por ejemplo:
            // $table->json('detalle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podia');
    }
};
