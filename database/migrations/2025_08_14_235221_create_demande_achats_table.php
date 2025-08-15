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
        Schema::create('demandes_achat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');
            $table->string('nom_acheteur');
            $table->string('email_acheteur');
            $table->string('telephone_acheteur');
            $table->integer('quantite_demandee');
            $table->text('message')->nullable();
            $table->enum('statut', ['en_attente', 'accepte', 'refuse', 'traite'])->default('en_attente');
            $table->timestamps();

            // Index pour améliorer les performances
            $table->index(['annonce_id', 'statut']);
            $table->index('email_acheteur');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes_achat');
    }
};