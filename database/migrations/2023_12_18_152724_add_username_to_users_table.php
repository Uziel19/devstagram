<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // es el que se ejecuta cuando realizas la migracion (siempre lo que vayamos colocar aqui tenemos que eliminarlo en el down)
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('username')->unique(); // crendo columna aqui

        });
    }

    // en los templates de blade no es obligatorio el ;
    /**
     * Reverse the migrations.
     */
    public function down(): void // cuando damos un rollback se ejecuta este metodo
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            //
        });
    }
};
