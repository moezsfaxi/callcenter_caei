<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\RdvThermostat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RdvThermostatController extends Controller
{
    public function index()
    {
        $rdvRecords = RdvThermostat::orderBy('created_at', 'desc')->paginate(20);
        $partenaires = User::where('role', 'partenaire')->get();

        return view('superviseur.indexrdvthermostat', compact('rdvRecords', 'partenaires'));
        $rdvRecords = RdvThermostat::orderBy('created_at', 'desc')->paginate(20);
        $partenaires = User::where('role', 'partenaire')->get();

        return view('superviseur.indexrdvthermostat', compact('rdvRecords', 'partenaires'));
    }
    public function create()
    {
        return view('agent.createthermostat');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'nom_du_prospect' => 'required|string',
            'prenom_du_prospect' => 'required|string',
            'telephone' => 'required|numeric',
            'adresse' => 'required|string',
            'code_postal' => 'required|numeric',
            'ville' => 'required|string',
            'date_du_rdv' => 'required|date',
            'statut_de_residence' => 'required|string',
            'Commentaire_agent' => 'nullable|string',
        ]);

        // Vérification si le numéro de téléphone existe déjà dans la base de données
        $existingRdv = RdvThermostat::where('telephone', $request->telephone)->first();

        if ($existingRdv) {
            // Si le numéro de téléphone existe déjà, on redirige avec un message d'erreur
            return redirect()->back()
                ->withInput()
                ->withErrors(['telephone' => 'Ce numéro de téléphone a déjà été utilisé pour un autre rendez-vous.']);
        }

        // Ajouter l'ID de l'agent à la liste des données validées
        $validatedData['agent_id'] = Auth::id();

        // Créer le rendez-vous
        $rdv = RdvThermostat::create($validatedData);

        // Redirection avec un message de succès
        return redirect()->route('agent.indexthermostat')
            ->with('success', 'Rendez-vous créé avec succès pour ' . $rdv->nom_du_prospect . ' ' . $rdv->prenom_du_prospect);
    }


  public function update(Request $request, $id)
{

    $validatedData = $request->validate([
        'Commentaire_partenaire' => 'required|string',
        'Commentaire_partenaire' => 'required|string',
        'classification' => 'required|string',
        'date_rappelle' => 'required|date',
    ]);


    $rdv = RdvThermostat::findOrFail($id);


    $rdv->update($validatedData);


    return redirect()->route('dashboard')->with('success', 'RDV updated successfully');
}

public function getRdvByAgent()
{

    $userId = Auth::id();
    $rdvRecords = RdvThermostat::where('agent_id', $userId)->get();
    return view('agent.indexthermostat', compact('rdvRecords'));
}
public function getRdvForPartenaireclassification()
    {
        $userId = Auth::id();
        $rdvRecords = RdvThermostat::where('partenaire_id', $userId)->whereNotNull('classification')->get();
        return view('your-view-name', compact('rdvRecords'));
    }
    public function getRdvForPartenairewithoutclassification()
    {
        $userId = Auth::id();
        $rdvRecords = RdvThermostat::where('partenaire_id', $userId)->whereNull('classification')->get();
        return view('your-view-name', compact('rdvRecords'));
    }


    public function destroy($id)
    {

        $rdv = RdvThermostat::findOrFail($id);
        $rdv->delete();
        return redirect()->route('dashboard')->with('success', 'RDV deleted successfully');
    }
    public function assignrdv(Request $request, $id)
{

    $validatedData = $request->validate([
        'partenaire_id' => 'nullable| numeric',

    ]);

    $rdv = RdvThermostat::findOrFail($id);
    $rdv->update($validatedData);

    return redirect()->route('dashboard')->with('success', 'RDV updated successfully');

}


}
