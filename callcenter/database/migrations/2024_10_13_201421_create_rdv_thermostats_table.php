<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rdv_thermostats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id'); 
            $table->unsignedBigInteger('partenaire_id');
            $table->text('nom_du_prospect');
            $table->text('prenom_du_prospect');
            $table->string('telephone');
            $table->text('adresse');
            $table->string('code_postal');
            $table->text('ville');
            $table->date('date_du_rdv');
            $table->text('statut_de_residence');
            $table->text('Commentaire_agent') ;
            $table->text('Commentaire_partenaire') ;
            $table->text('classification') ;
            $table->text('date_classification') ;
            $table->text('date_rappelle') ;
            $table->timestamps();
        }
    );
    }
    public function down(): void
    {
        Schema::dropIfExists('rdv_thermostats');
    }
};