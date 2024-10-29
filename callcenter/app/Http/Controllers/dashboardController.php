<?php

namespace App\Http\Controllers;

use App\Models\RdvPanneauxPhotovoltaique;
use App\Models\RdvPompeAChaleur;
use App\Models\RdvThermostat;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function agentdashboard()
    {
        $user = Auth::user();
       // $dateLimit = Carbon ::now()->subDays(30);
    
       
        $expectedClassifications = ['NRP','Hors cible','RDV confirmé','RDV installé','Pas intéressé','RDV annulé','RDV à rappeler'];
    
        
        $fillMissingClassifications = function ($data) use ($expectedClassifications) {
            $result = array_fill_keys($expectedClassifications, 0);
            foreach ($data as $classification => $total) {
                $result[$classification] = $total;
            }
            return $result;
        };
    
      
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
       
        $totalRdvPanneaux = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)
            ->count();
    
       
        $rdvPompeData = RdvPompeAChaleur::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        
        $totalRdvPompe = RdvPompeAChaleur::where('agent_id', $user->id)
            ->count();
    
     
        $rdvThermostatData = RdvThermostat::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
       
        $totalRdvThermostat = RdvThermostat::where('agent_id', $user->id)
            ->count();
    
        $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
        $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
        $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());

            //add
            $limitedClassifications = ['RDV confirmé', 'Hors cible', 'RDV annulé'];
    $lastSixMonthsData = [];
    
    for ($i = 0; $i < 6; $i++) {
        $month = Carbon::now()->subMonths($i)->format('F');
        $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
        $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();

        $monthData = [];
        foreach ($limitedClassifications as $classification) {
      
            $panneauxCount = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('classification', $classification)
                ->count();

            $pompeCount = RdvPompeAChaleur::where('agent_id', $user->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('classification', $classification)
                ->count();

            $thermostatCount = RdvThermostat::where('agent_id', $user->id)
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->where('classification', $classification)
                ->count();

            $monthData[$classification] = $panneauxCount + $pompeCount + $thermostatCount;
        }

        $lastSixMonthsData[$month] = $monthData;
    }

    
        $statistics = [
            'rdvPanneaux' => [
                'classification_data' => $rdvPanneauxData,
                'total' => $totalRdvPanneaux,
            ],
            'rdvPompe' => [
                'classification_data' => $rdvPompeData,
                'total' => $totalRdvPompe,
            ],
            'rdvThermostat' => [
                'classification_data' => $rdvThermostatData,
                'total' => $totalRdvThermostat,
            ],
            'lastSixMonths' => $lastSixMonthsData
        ];


        //dd($statistics);
        return view('agent/dashboard', compact('statistics'));
    }










    public function admindashboard()
        {
        //$user = Auth::user();
        //$dateLimit = Carbon::now()->subDays(30);
    
       
        $expectedClassifications = ['NRP','Hors cible','RDV confirmé','RDV installé','Pas intéressé','RDV annulé','RDV à rappeler'];
    
        
        $fillMissingClassifications = function ($data) use ($expectedClassifications) {
            $result = array_fill_keys($expectedClassifications, 0);
            foreach ($data as $classification => $total) {
                $result[$classification] = $total;
            }
            return $result;
        };
    
      
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
       
        $totalRdvPanneaux = RdvPanneauxPhotovoltaique::count();
    
       
        $rdvPompeData = RdvPompeAChaleur::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        
        $totalRdvPompe = RdvPompeAChaleur::count();
    
     
        $rdvThermostatData = RdvThermostat::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
       
        $totalRdvThermostat = RdvThermostat::count();
    
        $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
        $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
        $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());
    
        $statistics = [
            'rdvPanneaux' => [
                'classification_data' => $rdvPanneauxData,
                'total' => $totalRdvPanneaux,
            ],
            'rdvPompe' => [
                'classification_data' => $rdvPompeData,
                'total' => $totalRdvPompe,
            ],
            'rdvThermostat' => [
                'classification_data' => $rdvThermostatData,
                'total' => $totalRdvThermostat,
            ],
        ];
        $agentStatistics = User::where('role', 'agent')
        ->withCount([
            'rdvPanneauxPhotovoltaiques as rdvPanneaux',
            'rdvPompeAChaleurs as rdvPompe',
            'rdvThermostats as rdvThermostat'
        ])
        ->get()
        ->map(function ($agent) {
            return [
                'agent_name' => $agent->name,
                'rdvPanneaux' => $agent->rdvPanneaux ?? 0,
                'rdvPompe' => $agent->rdvPompe ?? 0,
                'rdvThermostat' => $agent->rdvThermostat ?? 0,
            ];
        });

        $partenaireStatistics = User::where('role', 'partenaire')
    ->withCount([
        'rdvPanneauxPhotovoltaiquesp as rdvPanneauxp',
        'rdvPompeAChaleursp as rdvPompep',
        'rdvThermostatsp as rdvThermostatp'
    ])
    ->get()
    ->map(function ($partenaire) {
        return [
            'partenaire_name' => $partenaire->name,
            'rdvPanneaux' => $partenaire->rdvPanneauxp ?? 0,
            'rdvPompe' => $partenaire->rdvPompep ?? 0,
            'rdvThermostat' => $partenaire->rdvThermostatp ?? 0,
        ];
    });
    
        // dd([
        //     'statistics' => $statistics,
        //     'agent_statistics' => $agentStatistics,
        //     "partenaire_statistics" => $partenaireStatistics
        // ]);
    
        return view('admin/dashboard', compact('statistics','agentStatistics','partenaireStatistics'));
    }


    public function superviseurdashboard()
    {
               
        $expectedClassifications = ['NRP','Hors cible','RDV confirmé','RDV installé','Pas intéressé','RDV annulé','RDV à rappeler'];
    
        
        $fillMissingClassifications = function ($data) use ($expectedClassifications) {
            $result = array_fill_keys($expectedClassifications, 0);
            foreach ($data as $classification => $total) {
                $result[$classification] = $total;
            }
            return $result;
        };
    
      
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
       
        $totalRdvPanneaux = RdvPanneauxPhotovoltaique::count();
    
       
        $rdvPompeData = RdvPompeAChaleur::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        
        $totalRdvPompe = RdvPompeAChaleur::count();
    
     
        $rdvThermostatData = RdvThermostat::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
       
        $totalRdvThermostat = RdvThermostat::count();
    
        $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
        $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
        $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());
    
        $statistics = [
            'rdvPanneaux' => [
                'classification_data' => $rdvPanneauxData,
                'total' => $totalRdvPanneaux,
            ],
            'rdvPompe' => [
                'classification_data' => $rdvPompeData,
                'total' => $totalRdvPompe,
            ],
            'rdvThermostat' => [
                'classification_data' => $rdvThermostatData,
                'total' => $totalRdvThermostat,
            ],
        ];
        $agentStatistics = User::where('role', 'agent')
        ->withCount([
            'rdvPanneauxPhotovoltaiques as rdvPanneaux',
            'rdvPompeAChaleurs as rdvPompe',
            'rdvThermostats as rdvThermostat'
        ])
        ->get()
        ->map(function ($agent) {
            return [
                'agent_name' => $agent->name,
                'rdvPanneaux' => $agent->rdvPanneaux ?? 0,
                'rdvPompe' => $agent->rdvPompe ?? 0,
                'rdvThermostat' => $agent->rdvThermostat ?? 0,
            ];
        });

        $partenaireStatistics = User::where('role', 'partenaire')
    ->withCount([
        'rdvPanneauxPhotovoltaiquesp as rdvPanneauxp',
        'rdvPompeAChaleursp as rdvPompep',
        'rdvThermostatsp as rdvThermostatp'
    ])
    ->get()
    ->map(function ($partenaire) {
        return [
            'partenaire_name' => $partenaire->name,
            'rdvPanneaux' => $partenaire->rdvPanneauxp ?? 0,
            'rdvPompe' => $partenaire->rdvPompep ?? 0,
            'rdvThermostat' => $partenaire->rdvThermostatp ?? 0,
        ];
    });
    
        // dd([
        //     'statistics' => $statistics,
        //     'agent_statistics' => $agentStatistics,
        //     "partenaire_statistics" => $partenaireStatistics
        // ]);
        return view('superviseur/dashboard',compact('statistics','agentStatistics','partenaireStatistics'));
        
    }
   
   
   
   
    public function partenairedashboard()
    {

        $user = Auth::user();
        // $dateLimit = Carbon ::now()->subDays(30);
     
        
         $expectedClassifications = ['NRP','Hors cible','RDV confirmé','RDV installé','Pas intéressé','RDV annulé','RDV à rappeler'];
     
         
         $fillMissingClassifications = function ($data) use ($expectedClassifications) {
             $result = array_fill_keys($expectedClassifications, 0);
             foreach ($data as $classification => $total) {
                 $result[$classification] = $total;
             }
             return $result;
         };
     
       
         $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
             ->selectRaw("classification, count(*) as total")
             ->groupBy('classification')
             ->get()
             ->pluck('total', 'classification');
     
        
         $totalRdvPanneaux = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
             ->count();
     
        
         $rdvPompeData = RdvPompeAChaleur::where('partenaire_id', $user->id)
             ->selectRaw("classification, count(*) as total")
             ->groupBy('classification')
             ->get()
             ->pluck('total', 'classification');
     
         
         $totalRdvPompe = RdvPompeAChaleur::where('partenaire_id', $user->id)
             ->count();
     
      
         $rdvThermostatData = RdvThermostat::where('partenaire_id', $user->id)
             ->selectRaw("classification, count(*) as total")
             ->groupBy('classification')
             ->get()
             ->pluck('total', 'classification');
     
        
         $totalRdvThermostat = RdvThermostat::where('partenaire_id', $user->id)
             ->count();
     
         $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
         $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
         $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());
 
             //add
             $limitedClassifications = ['RDV confirmé', 'Hors cible', 'RDV annulé'];
     $lastSixMonthsData = [];
     
     for ($i = 0; $i < 6; $i++) {
         $month = Carbon::now()->subMonths($i)->format('F');
         $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
         $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();
 
         $monthData = [];
         foreach ($limitedClassifications as $classification) {
       
             $panneauxCount = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
                 ->whereBetween('created_at', [$monthStart, $monthEnd])
                 ->where('classification', $classification)
                 ->count();
 
             $pompeCount = RdvPompeAChaleur::where('partenaire_id', $user->id)
                 ->whereBetween('created_at', [$monthStart, $monthEnd])
                 ->where('classification', $classification)
                 ->count();
 
             $thermostatCount = RdvThermostat::where('partenaire_id', $user->id)
                 ->whereBetween('created_at', [$monthStart, $monthEnd])
                 ->where('classification', $classification)
                 ->count();
 
             $monthData[$classification] = $panneauxCount + $pompeCount + $thermostatCount;
         }
 
         $lastSixMonthsData[$month] = $monthData;
     }
 
     
         $statistics = [
             'rdvPanneaux' => [
                 'classification_data' => $rdvPanneauxData,
                 'total' => $totalRdvPanneaux,
             ],
             'rdvPompe' => [
                 'classification_data' => $rdvPompeData,
                 'total' => $totalRdvPompe,
             ],
             'rdvThermostat' => [
                 'classification_data' => $rdvThermostatData,
                 'total' => $totalRdvThermostat,
             ],
             'lastSixMonths' => $lastSixMonthsData
         ];



        return view('partenaire/dashboard',compact('statistics'));
    }



}
