<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\RdvPanneauxPhotovoltaique;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RdvPanneauxPhotovoltaiqueController extends Controller
{

    public function index()
    {
        $rdvRecords = RdvPanneauxPhotovoltaique::orderBy('created_at', 'desc')->paginate(20);
        $partenaires = User::where('role', 'partenaire')->get();

        return view('superviseur.indexpanneau', compact('rdvRecords', 'partenaires'));
    }

    public function create()
    {
        return view('agent.createpv');
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
     $existingRdv = RdvPanneauxPhotovoltaique::where('telephone', $request->telephone)->first();

     if ($existingRdv) {
         // Si le numéro de téléphone existe déjà, on redirige avec un message d'erreur
         return redirect()->back()
             ->withInput()
             ->withErrors(['telephone' => 'Ce numéro de téléphone a déjà été utilisé pour un autre rendez-vous.']);
     }
    $validatedData['agent_id'] = Auth::id();
    $rdv = RdvPanneauxPhotovoltaique::create($validatedData);
    return redirect()->route('rdv.PanneauxPhotovoltaiqueAgent')->with('success', 'RDV created successfully');
}

public function update(Request $request, $id)
{

    $validatedData = $request->validate([
        'Commentaire_partenaire' => 'nullable|string',
        'classification' => 'required|string',
        'date_rappelle' => 'required|date',
    ]);
    $rdv = RdvPanneauxPhotovoltaique::findOrFail($id);
    $rdv->update($validatedData);
    return redirect()->route('rdv.PanneauxPhotovoltaiquepartenaire')->with('success', 'RDV updated successfully');
}

public function assignrdv(Request $request, $id)
{

    $validatedData = $request->validate([
        'partenaire_id' => 'required| numeric',

    ]);
    $rdv = RdvPanneauxPhotovoltaique::findOrFail($id);
    $rdv->update($validatedData);
    return redirect()->route('superviseur-rdv-panneaux-photovoltaique.index')->with('success', 'RDV updated successfully');
}

   public function getRdvByAgent()
    {

        $userId = Auth::id();
        $rdvRecords = RdvPanneauxPhotovoltaique::where('agent_id', $userId)->get();
        return view('agent.indexpv', compact('rdvRecords'));
    }


    public function getRdvForPartenaire()
    {
        $userId = Auth::id();
         // Récupère les RDV non qualifiés pour le partenaire
        $rdvRecords = RdvPanneauxPhotovoltaique::where('partenaire_id', $userId)
         ->whereNull('classification') // Filtre pour les RDV non qualifiés
         ->orderBy('created_at', 'desc')
         ->get();
        return view('partenaire.indexpanneau', compact('rdvRecords'));
    }
    public function getRdvForPartenaireQualified()
{
    $userId = Auth::id();
    $rdvRecords = RdvPanneauxPhotovoltaique::where('partenaire_id', $userId)
                    ->whereNotNull('classification')  // Pour les RDV qualifiés
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('partenaire.rdvqualifierpv', compact('rdvRecords'));
}

    public function destroy($id)
    {
        $rdv = RdvPanneauxPhotovoltaique::findOrFail($id);
        $rdv->delete();
        return redirect()->route('dashboard')->with('success', 'RDV deleted successfully');
    }

    public function updatequalification(Request $request, $id)
    {
        $validatedData = $request->validate([
            'classification' => 'required|string',
            'Commentaire_partenaire' => 'nullable|string',
            'date_rappelle' => 'nullable|date',
        ]);

        $rdv = RdvPanneauxPhotovoltaique::findOrFail($id);

        $rdv->classification = $validatedData['classification'];
        $rdv->Commentaire_partenaire = $validatedData['Commentaire_partenaire'];
        $rdv->date_rappelle = $validatedData['date_rappelle'];

        $rdv->save();

        return redirect()->route('rdv.QPanneauxPhotovoltaiquepartenaire')->with('success', 'Rendez-vous mis à jour avec succès');
    }
    public function updateRdvPanneau(Request $request, $id)
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

        $rdv = RdvPanneauxPhotovoltaique::findOrFail($id);

        // Update only the fields that are present in the request
        foreach ($validatedData as $key => $value) {
            if (!is_null($value)) {
                $rdv->$key = $value;
            }
        }

        $rdv->save();

        return redirect()->back()->with('success', 'Rendez-vous pompe à chaleur mis à jour avec succès');
    }
}
