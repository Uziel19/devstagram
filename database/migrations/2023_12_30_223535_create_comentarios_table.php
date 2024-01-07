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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');; // se relaciona con el id que este en la tabla respectiva donde este utilizando la convencion que sugiere laravel
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // es por eso que se agrega este constrained  y este onDelete para preservar la integridad de la informacion de  los datos
            $table->string('comentario');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};

// cuando se hace un cambio en algun campo eso lleva a aplicar un rollback y volver a migrar