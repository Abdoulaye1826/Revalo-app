<?php

// database/migrations/2024_01_01_000001_create_annonces_table.php
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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('categorie');
            $table->integer('quantite');
            $table->decimal('prix', 10, 2);
            $table->string('localisation');
            $table->string('image')->nullable();
            $table->timestamps();

            // Index pour améliorer les performances
            $table->index(['categorie', 'prix']);
            $table->index('localisation');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
