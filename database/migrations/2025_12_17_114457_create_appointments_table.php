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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();//Identifiant unique du RDV
            $table->foreignID('user_id')->nullable()->constrained()->onDelete('cascade');//user_id, optionnel si tu as des users connectés
            $table->string('email');//Email du clt
            $table->date('date');//Jour du RDV
            $table->time('hour');//Heure du RDV
            $table->enum('status', ['reserved', 'canceled', 'done'])->default('reserved');//statut du RDV
            $table->timestamps();//RDV crée à telle date et mis à jour à ...
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
