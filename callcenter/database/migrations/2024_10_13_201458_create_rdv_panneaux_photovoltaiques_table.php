<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rdv_panneaux_photovoltaiques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('partenaire_id')->nullable();
            $table->text('nom_du_prospect');
            $table->text('prenom_du_prospect');
            $table->string('telephone');
            $table->text('adresse');
            $table->string('code_postal');
            $table->text('ville');
            $table->date('date_du_rdv');
            $table->text('statut_de_residence');
            $table->text('Commentaire_agent') ;
            $table->text('Commentaire_partenaire')->nullable() ;
            $table->enum('classification', ['NRP','Hors cible','RDV confirmé','RDV installé','Pas intéressé','RDV annulé','RDV à rappeler'])->nullable();
            $table->text('date_classification')->nullable() ;
            $table->text('date_rappelle')->nullable() ;
            $table->timestamps();
        }

    );
    }
    public function down(): void
    {
        Schema::dropIfExists('rdv_panneaux_photovoltaiques');
    }
};
