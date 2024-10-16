<?php

namespace App\Http\Controllers;

use App\Models\RdvPanneauxPhotovoltaique;
use App\Models\RdvPompeAChaleur;
use App\Models\RdvThermostat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function agentdashboard()
    {
        $user = Auth::user();
        $dateLimit = Carbon::now()->subDays(30);
    
        
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)
            ->where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $rdvPompeData = RdvPompeAChaleur::where('agent_id', $user->id)
            ->where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $rdvThermostatData = RdvThermostat::where('agent_id', $user->id)
            ->where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $statistics = [
            'rdvPanneaux' => $rdvPanneauxData->toArray(),
            'rdvPompe' => $rdvPompeData->toArray(),
            'rdvThermostat' => $rdvThermostatData->toArray(),
        ];                                           
            
        return view('agent/dashboard',compact('statistics'));
    }
    public function admindashboard()
    {
        $dateLimit = Carbon::now()->subDays(30);
        
            
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $rdvPompeData = RdvPompeAChaleur::where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $rdvThermostatData = RdvThermostat::where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $statistics = [
            'rdvPanneaux' => $rdvPanneauxData->toArray(),
            'rdvPompe' => $rdvPompeData->toArray(),
            'rdvThermostat' => $rdvThermostatData->toArray(),
        ]; 
        return view('admin/dashboard' ,compact($statistics));
    }
    public function superviseurdashboard()
    {

        $dateLimit = Carbon::now()->subDays(30);
        
            
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $rdvPompeData = RdvPompeAChaleur::where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $rdvThermostatData = RdvThermostat::where('created_at', '>=', $dateLimit)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $statistics = [
            'rdvPanneaux' => $rdvPanneauxData->toArray(),
            'rdvPompe' => $rdvPompeData->toArray(),
            'rdvThermostat' => $rdvThermostatData->toArray(),
        ]; 

        return view('superviseur/dashboard' ,compact($statistics) );
    }
    
    public function partenairedashboard()
    {
    
            $user = Auth::user();
            $dateLimit = Carbon::now()->subDays(30);
        
            
            $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
                ->where('created_at', '>=', $dateLimit)
                ->selectRaw("classification, count(*) as total")
                ->groupBy('classification')
                ->get()
                ->pluck('total', 'classification');
        
            $rdvPompeData = RdvPompeAChaleur::where('agent_id', $user->id)
                ->where('created_at', '>=', $dateLimit)
                ->selectRaw("classification, count(*) as total")
                ->groupBy('classification')
                ->get()
                ->pluck('total', 'classification');
        
            $rdvThermostatData = RdvThermostat::where('agent_id', $user->id)
                ->where('created_at', '>=', $dateLimit)
                ->selectRaw("classification, count(*) as total")
                ->groupBy('classification')
                ->get()
                ->pluck('total', 'classification');
        
            $statistics = [
                'rdvPanneaux' => $rdvPanneauxData->toArray(),
                'rdvPompe' => $rdvPompeData->toArray(),
                'rdvThermostat' => $rdvThermostatData->toArray(),
            ]; 

        return view('partenaire/dashboard', compact($statistics));
    

}



}
