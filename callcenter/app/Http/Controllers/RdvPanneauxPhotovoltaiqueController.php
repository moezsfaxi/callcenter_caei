<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\RdvPanneauxPhotovoltaique;
use App\Models\RdvPompeAChaleur;
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

    return redirect()->route('dashboard')->with('success', 'RDV updated successfully');
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
        $rdvRecords = RdvPanneauxPhotovoltaique::where('partenaire_id', $userId)->get();
        return view('your-view-name', compact('rdvRecords'));
    }
    public function destroy($id)
    {

        $rdv = RdvPanneauxPhotovoltaique::findOrFail($id);
        $rdv->delete();
        return redirect()->route('dashboard')->with('success', 'RDV deleted successfully');
    }
    public function getRdvForPartenaireclassification()
    {
        $userId = Auth::id();
        $rdvRecords = RdvPanneauxPhotovoltaique::where('partenaire_id', $userId)->whereNotNull('classification')->get();
        return view('your-view-name', compact('rdvRecords'));
    }
    public function getRdvForPartenairewithoutclassification()
    {
        $userId = Auth::id();
        $rdvRecords = RdvPanneauxPhotovoltaique::where('partenaire_id', $userId)->whereNull('classification')->get();
        return view('your-view-name', compact('rdvRecords'));
    }


}
