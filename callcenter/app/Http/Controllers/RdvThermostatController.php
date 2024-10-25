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
        return redirect()->route('rdv.ThermostatAgent') ->with('success', 'Rendez-vous créé avec succès pour ' . $rdv->nom_du_prospect . ' ' . $rdv->prenom_du_prospect);
    }


  public function update(Request $request, $id)
{

    $validatedData = $request->validate([
        'Commentaire_partenaire' => 'required|string',
        'classification' => 'required|string',
        'date_rappelle' => 'date',
    ]);

    $rdv = RdvThermostat::findOrFail($id);

    $rdv->update($validatedData);

    return redirect()->route('rdv.Thermostatpartenaire')->with('success', 'RDV updated successfully');
}
public function updaterdvThermostat(Request $request, $id)
{
    $validatedData = $request->validate([
        'nom_du_prospect' => 'nullable|string|max:255',
        'prenom_du_prospect' => 'nullable|string|max:255',
        'telephone' => 'nullable|string|max:20',
        'adresse' => 'nullable|string|max:255',
        'code_postal' => 'nullable|string|max:10',
        'ville' => 'nullable|string|max:255',
        'date_du_rdv' => 'nullable|date',
        'statut_de_residence' => 'nullable|string|max:255',
        'Commentaire_agent' => 'nullable|string',
    ]);

    $rdv = RdvThermostat::findOrFail($id);

    // Update only the fields that are present in the request
    foreach ($validatedData as $key => $value) {
        if (!is_null($value)) {
            $rdv->$key = $value;
        }
    }

    $rdv->save();

    return redirect()->back()->with('success', 'Rendez-vous mis à jour avec succès');
}

public function updatequalification(Request $request, $id)
{
    $validatedData = $request->validate([
        'Commentaire_partenaire' => 'nullable|string',
        'classification' => 'required|string',
        'date_rappelle' => 'nullable|date',
    ]);

    $rdv = RdvThermostat::findOrFail($id);

    // Récupérer les anciennes valeurs si elles ne sont pas fournies
    if (empty($validatedData['Commentaire_partenaire'])) {
        $validatedData['Commentaire_partenaire'] = $rdv->Commentaire_partenaire;
    }
    if (empty($validatedData['date_rappelle'])) {
        $validatedData['date_rappelle'] = $rdv->date_rappelle;
    }

    $rdv->update($validatedData);
    return redirect()->route('rdv.thermostat.qualifies')->with('success', 'Qualification mise à jour avec succès');
}

public function getRdvByAgent()
{

    $userId = Auth::id();
    $rdvRecords = RdvThermostat::where('agent_id', $userId)->paginate(20);
    return view('agent.indexthermostat', compact('rdvRecords'));
}
public function getRdvForPartenaireQualifier()
{
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté

    // Récupère les RDV qualifiés pour le partenaire
    $rdvRecords = RdvThermostat::where('partenaire_id', $userId)
        ->whereNotNull('classification') // Filtre pour les RDV qualifiés
        ->get();

    return view('partenaire.rdvqualifierthermostat', compact('rdvRecords')); // Renvoie la vue avec les RDV qualifiés
}

public function getRdvForPartenaire()
{
    $userId = Auth::id(); 
    
    $rdvRecords = RdvThermostat::where('partenaire_id', $userId)
        ->whereNull('classification') 
        ->orderBy('created_at', 'desc')
        ->paginate(20); 

    return view('partenaire.indexthermostat', compact('rdvRecords'));
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
            'partenaire_id' => 'required|numeric',
        ]);

        $rdv = RdvThermostat::findOrFail($id);
        $rdv->update($validatedData);

        return redirect()->route('superviseur-rdv-thermostat.index')->with('success', 'RDV updated successfully');
    }

    public function indexforadmin()
    {
        $rdvRecords = RdvThermostat::orderBy('created_at', 'desc')->paginate(20);
        

        return view('admin.indexthermostat', compact('rdvRecords'));
    }




}
