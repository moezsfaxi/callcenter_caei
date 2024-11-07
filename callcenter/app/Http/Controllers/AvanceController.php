<?php

namespace App\Http\Controllers;

use App\Models\Avance;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AvanceController extends Controller
{
    
    public function index()
    {
        $avances = Avance::where('agent_id', Auth::id())
        ->orderBy('created_at', 'desc')->paginate(20);
        return view('agent.avance', compact('avances'));
    }
    public function store(Request $request)
    {
        $request->validate([
            
            'amount' => 'required',
            'comment' => 'nullable|string|max:500',
        ]);

        $avance = new Avance();
        $avance->agent_id = Auth::id();
        $avance->etat = 'en attente';
        $avance->amount=$request->amount;
        $avance->comment = $request->comment;

        $avance->save();

        return redirect()->route('avance.index')
            ->with('success', 'Votre demande d\'avance a été soumise avec succès!');
    }

    public function indexsuperviseur()
    {
        $avances = Avance::with('agent')
        ->orderBy('created_at', 'desc')->paginate(20);
        
        return view('superviseur.avance', compact('avances'));
    }
    public function indexadmin()
    {
        $avances = Avance::with('agent')
        ->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.avance', compact('avances'));
    }

        
    public function updateEtat(Request $request, $id)
    {
        $request->validate([
            'etat' => 'required|in:accepté,refusé',
        ]);
    
        $avance = Avance::findOrFail($id);
    
        
        if ($avance->etat === 'en attente') {
            $avance->etat = $request->etat;
            $avance->save();
    
            return redirect()->back()->with('status', 'avance status updated successfully!');
        }
    
        return redirect()->back()->withErrors('Cannot change status.');
    }






}
