<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RdvPompeAChaleur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RdvPompeAChaleurController extends Controller
{

    public function index()
    {
        $rdvRecords = RdvPompeAChaleur::orderBy('created_at', 'desc')->paginate(20);
        $partenaires = User::where('role', 'partenaire')->get();

        return view('superviseur.indexpompe-a-chaleur', compact('rdvRecords', 'partenaires'));
    }
    public function create()
    {
        return view('agent.createpac');
    }

    public function store(Request $request)
  {

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
    $existingRdv = RdvPompeAChaleur::where('telephone', $request->telephone)->first();

    if ($existingRdv) {
        // Si le numéro de téléphone existe déjà, on redirige avec un message d'erreur
        return redirect()->back()
            ->withInput()
            ->withErrors(['telephone' => 'Ce numéro de téléphone a déjà été utilisé pour un autre rendez-vous.']);
    }
          $validatedData['agent_id'] = Auth::id();

          $rdv = RdvPompeAChaleur::create($validatedData);
    return redirect()->route('rdv.PompeAChaleurAgent')->with('success', 'RDV created successfully');
}
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'Commentaire_partenaire' => 'nullable|string',
        'classification' => 'required|string',
        'date_rappelle' => 'required|date',
    ]);
    $rdv = RdvPompeAChaleur::findOrFail($id);
    $rdv->update($validatedData);
    return redirect()->back()->with('success', 'Le rendez-vous a été mis à jour avec succès.');

}

public function getRdvByAgent()
    {
        $userId = Auth::id();
        $rdvRecords = RdvPompeAChaleur::where('agent_id', $userId)->paginate(20);
        return view('agent.indexpac', compact('rdvRecords'));
    }
    public function getRdvForPartenaireQualifier()
{
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    // Récupère les RDV qualifiés pour le partenaire
    $rdvRecords = RdvPompeAChaleur::where('partenaire_id', $userId)
        ->whereNotNull('classification') // Filtre pour les RDV qualifiés
        ->get();

    return view('partenaire.rdvqualifierpompe', compact('rdvRecords')); // Renvoie la vue avec les RDV qualifiés
}

    public function getRdvForPartenaire()
    {
        $userId = Auth::id();
         // Récupère les RDV non qualifiés pour le partenaire
            $rdvRecords = RdvPompeAChaleur::where('partenaire_id', $userId)
            ->whereNull('classification') // Filtre pour les RDV non qualifiés
            ->orderBy('created_at', 'desc')
            ->get();
        return view('partenaire.indexpompeachaleur', compact('rdvRecords'));
    }
    public function assignrdv(Request $request, $id)
    {

        $validatedData = $request->validate([
            'partenaire_id' => 'required| numeric',

        ]);
        $rdv = RdvPompeAChaleur::findOrFail($id);
        $rdv->update($validatedData);
        return redirect()->route('superviseur-rdv-pompe-a-chaleur.index')->with('success', 'RDV updated successfully');
    }
    public function destroy($id)
    {
        $rdv = RdvPompeAChaleur::findOrFail($id);
        $rdv->delete();

        return redirect()->route('first-page')->with('success', 'RDV deleted successfully');
    }

    public function getRdvQualifiesForPartenaire()
    {
        $userId = Auth::id();
        $rdvRecords = RdvPompeAChaleur::where('partenaire_id', $userId)
                    ->whereNotNull('classification')  // Pour les RDV qualifiés
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('partenaire.rdvqualifierpompe', compact('rdvRecords'));
    }

    public function updatequalification(Request $request, $id)
    {
        $validatedData = $request->validate([
            'classification' => 'required|string',
            'Commentaire_partenaire' => 'nullable|string',
            'date_rappelle' => 'nullable|date',
        ]);

        $rdv = RdvPompeAChaleur::findOrFail($id);
        $rdv->update($validatedData);

        return redirect()->back()->with('success', 'Le rendez-vous a été mis à jour avec succès.');
    }

    public function updateRdvPompeAChaleur(Request $request, $id)
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

        $rdv = RdvPompeAChaleur::findOrFail($id);

        // Update only the fields that are present in the request
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                $rdv->$key = $value;
            }
        }

        $rdv->save();

        return redirect()->back()->with('success', 'Rendez-vous pompe à chaleur mis à jour avec succès');
    }

    public function indexforadmin()
    {
        $rdvRecords = RdvPompeAChaleur::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.indexpac', compact('rdvRecords'));
    }




}
