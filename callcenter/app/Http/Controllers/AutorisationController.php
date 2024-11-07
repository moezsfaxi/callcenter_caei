<?php

namespace App\Http\Controllers;

use App\Models\Autorisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutorisationController extends Controller
{
    public function index()
    {
        $autorisations = Autorisation::where('agent_id', Auth::id())
        ->orderBy('created_at', 'desc')->paginate(20);
        return view('agent.autorisation', compact('autorisations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_type' => 'required|in:hours,days',
            'single_date' => 'required_if:request_type,hours|date|nullable',
            'hours' => 'required_if:request_type,hours|nullable|in:1,2,3,4,5',
            'start_date' => 'required_if:request_type,days|date|nullable',
            'end_date' => 'required_if:request_type,days|date|nullable|after_or_equal:start_date',
            'comment' => 'nullable|string|max:500',
        ]);

        $autorisation = new Autorisation();
        $autorisation->agent_id = Auth::id();
        $autorisation->etat = 'en attente';

        if ($request->request_type === 'hours') {
            $autorisation->start_date = $request->single_date;
            $autorisation->end_date = $request->single_date;
            $autorisation->hours = $request->hours;
        } else {
            $autorisation->start_date = $request->start_date;
            $autorisation->end_date = $request->end_date;
            $autorisation->hours = null;
        }
        $autorisation->comment = $request->comment;

        $autorisation->save();

        return redirect()->route('autorisation.index')
            ->with('success', 'Votre demande d\'autorisation a été soumise avec succès!');
    }


    public function indexsuperviseur()
    {
        $autorisations = Autorisation::with('agent')
        ->orderBy('created_at', 'desc')->paginate(20);
        
        return view('superviseur.autorisation', compact('autorisations'));
    }
    public function indexadmin()
    {
        $autorisations = Autorisation::with('agent')
        ->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.autorisation', compact('autorisations'));
    }


    public function updateEtat(Request $request, $id)
    {
        $request->validate([
            'etat' => 'required|in:accepté,refusé',
        ]);
    
        $autorisation = Autorisation::findOrFail($id);
    
        
        if ($autorisation->etat === 'en attente') {
            $autorisation->etat = $request->etat;
            $autorisation->save();
    
            return redirect()->back()->with('status', 'Autorisation status updated successfully!');
        }
    
        return redirect()->back()->withErrors('Cannot change status.');
    }
}