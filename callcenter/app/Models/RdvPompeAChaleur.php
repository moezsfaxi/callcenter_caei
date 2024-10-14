<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RdvPompeAChaleur extends Model
{
    use HasFactory;


    protected $fillable = [
        'agent_id',
        'partenaire_id',
        'nom_du_prospect',
        'prenom_du_prospect',
        'telephone',
        'adresse',
        'code_postal',
        'ville',
        'date_du_rdv',
        'statut_de_residence',
        'Commentaire_agent',
        'Commentaire_partenaire',
        'classification',
        'date_classification',
        'date_rappelle',
    ];   

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function partenaire()
    {
        return $this->belongsTo(User::class, 'partenaire_id');
    }



        
}
