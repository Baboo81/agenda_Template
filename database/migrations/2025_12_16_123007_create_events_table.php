<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cette méthode est appelée lorsque tu exécutes la migration avec `php artisan migrate`.
        // Elle sert à créer ou modifier des tables dans la base de données.

        Schema::create('events', function (Blueprint $table) {
            // Crée une nouvelle table nommée 'events'.
            // La variable $table est un objet Blueprint qui permet de définir les colonnes et leurs types.

            $table->id();
            // Crée une colonne `id` de type BIGINT auto-incrémentée qui servira de clé primaire.

            $table->string('title');
            // Crée une colonne `title` de type VARCHAR pour stocker le titre de l'événement.

            $table->text('description')->nullable();
            // Crée une colonne `description` de type TEXT pour stocker des détails.
            // La méthode `nullable()` signifie que cette colonne peut rester vide.

            $table->dateTime('start_time');
            // Crée une colonne `start_time` de type DATETIME pour stocker la date et l'heure de début de l'événement.

            $table->dateTime('end_time')->nullable();
            // Crée une colonne `end_time` de type DATETIME pour stocker la date et l'heure de fin.
            // Elle est optionnelle (nullable), donc tu peux avoir des événements sans heure de fin.

            $table->timestamps();
            // Crée deux colonnes `created_at` et `updated_at` qui seront automatiquement gérées par Laravel.
            // Elles permettent de savoir quand l'événement a été créé ou modifié.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
