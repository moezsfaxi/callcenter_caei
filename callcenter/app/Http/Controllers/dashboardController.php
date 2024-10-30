<?php

namespace App\Http\Controllers;

use App\Models\RdvAudit;
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

        $expectedClassifications = ['NRP', 'Hors cible', 'RDV confirmé', 'RDV installé', 'Pas intéressé', 'RDV annulé', 'RDV à rappeler'];

        $fillMissingClassifications = function ($data) use ($expectedClassifications) {
            $result = array_fill_keys($expectedClassifications, 0);
            foreach ($data as $classification => $total) {
                $result[$classification] = $total;
            }
            return $result;
        };

        // Récupération des données pour chaque type de rendez-vous
        $rdvPanneauxData = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');

        $totalRdvPanneaux = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)->count();

        $rdvPompeData = RdvPompeAChaleur::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');

        $totalRdvPompe = RdvPompeAChaleur::where('agent_id', $user->id)->count();

        $rdvThermostatData = RdvThermostat::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');

        $totalRdvThermostat = RdvThermostat::where('agent_id', $user->id)->count();

        $rdvAuditData = RdvAudit::where('agent_id', $user->id)
            ->selectRaw("classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');

        $totalRdvAudit = RdvAudit::where('agent_id', $user->id)->count();

        // Remplissage des classifications manquantes
        $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
        $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
        $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());
        $rdvAuditData = $fillMissingClassifications($rdvAuditData->toArray());

        // Récupérer les données pour les deux derniers mois
        $limitedClassifications = ['RDV confirmé', 'Hors cible', 'RDV annulé'];
        $lastTwoMonthsData = [];

        for ($i = 0; $i < 2; $i++) {
            $month = Carbon::now()->subMonths($i)->format('F');
            $monthStart = Carbon::now()->subMonths($i)->startOfMonth();
            $monthEnd = Carbon::now()->subMonths($i)->endOfMonth();

            $monthData = [
                'panneaux' => [],
                'pompe' => [],
                'thermostat' => [],
                'audit' => [],
            ];

            foreach ($limitedClassifications as $classification) {
                // Count for each RDV type
                $monthData['panneaux'][$classification] = RdvPanneauxPhotovoltaique::where('agent_id', $user->id)
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->where('classification', $classification)
                    ->count();

                $monthData['pompe'][$classification] = RdvPompeAChaleur::where('agent_id', $user->id)
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->where('classification', $classification)
                    ->count();

                $monthData['thermostat'][$classification] = RdvThermostat::where('agent_id', $user->id)
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->where('classification', $classification)
                    ->count();

                $monthData['audit'][$classification] = RdvAudit::where('agent_id', $user->id)
                    ->whereBetween('created_at', [$monthStart, $monthEnd])
                    ->where('classification', $classification)
                    ->count();
            }

            $lastTwoMonthsData[$month] = $monthData;
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
            'rdvAudit' => [
                'classification_data' => $rdvAuditData,
                'total' => $totalRdvAudit,
            ],
            'lastTwoMonths' => $lastTwoMonthsData // Ajout des données des deux derniers mois
        ];
        //dd($statistics);
        return view('agent/dashboard', compact('statistics'));
    }


    public function admindashboard()
    {
        $expectedClassifications = ['NRP', 'Hors cible', 'RDV confirmé', 'RDV installé', 'Pas intéressé', 'RDV annulé', 'RDV à rappeler'];

        $fillMissingClassifications = function ($data) use ($expectedClassifications) {
            $result = array_fill_keys($expectedClassifications, 0);
            foreach ($data as $classification => $total) {
                $result[$classification] = $total;
            }
            return $result;
        };

        // Récupération des données globales par classification pour chaque type de RDV
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

        $rdvAuditData = RdvAudit::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');

        $totalRdvAudit = RdvAudit::count();


        // Remplissage des classifications manquantes avec zéro
        $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
        $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
        $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());
        $rdvAuditData = $fillMissingClassifications($rdvAuditData->toArray());

        // Préparation des statistiques globales
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
            'rdvAudit' => [
                'classification_data' => $rdvAuditData,
                'total' => $totalRdvAudit,
            ],
        ];

        // Récupération des données journalières pour les rendez-vous
        $dailyRdvThermostatData = RdvThermostat::selectRaw("DATE(created_at) as date, count(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $dailyRdvPanneauxData = RdvPanneauxPhotovoltaique::selectRaw("DATE(created_at) as date, count(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $dailyRdvPompeData = RdvPompeAChaleur::selectRaw("DATE(created_at) as date, count(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        $dailyRdvAuditData = RdvAudit::selectRaw("DATE(created_at) as date, count(*) as total")
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date');

        // Préparation des statistiques par agent
        $agentStatistics = User::where('role', 'agent')
            ->withCount([
                'rdvPanneauxPhotovoltaiques as rdvPanneaux',
                'rdvPompeAChaleurs as rdvPompe',
                'rdvThermostats as rdvThermostat',
                'rdvAudits as rdvAudit'
            ])
            ->get()
            ->map(function ($agent) {
                return [
                    'agent_name' => $agent->name,
                    'rdvPanneaux' => $agent->rdvPanneaux ?? 0,
                    'rdvPompe' => $agent->rdvPompe ?? 0,
                    'rdvThermostat' => $agent->rdvThermostat ?? 0,
                    'rdvAudit'  => $agent->rdvAudit ?? 0,
                ];
            });

        $partenaireStatistics = User::where('role', 'partenaire')
            ->withCount([
                'rdvPanneauxPhotovoltaiquesp as rdvPanneauxp',
                'rdvPompeAChaleursp as rdvPompep',
                'rdvThermostatsp as rdvThermostatp',
                'rdvAuditsp as rdvAuditp'
            ])
            ->get()
            ->map(function ($partenaire) {
                return [
                    'partenaire_name' => $partenaire->name,
                    'rdvPanneaux' => $partenaire->rdvPanneauxp ?? 0,
                    'rdvPompe' => $partenaire->rdvPompep ?? 0,
                    'rdvThermostat' => $partenaire->rdvThermostatp ?? 0,
                    'rdvAudit'  => $partenaire->rdvAuditp ?? 0,
                ];
            });
        // Retour des données vers la vue
        return view('admin/dashboard', [
            'statistics' => $statistics,
            'dailyRdvThermostatData' => $dailyRdvThermostatData,
            'dailyRdvPanneauxData' => $dailyRdvPanneauxData,
            'dailyRdvPompeData' => $dailyRdvPompeData,
            'dailyRdvAuditData' => $dailyRdvAuditData,
            'partenaireStatistics' => $partenaireStatistics,
            'agentStatistics' => $agentStatistics,

        ]);
    }


    public function superviseurdashboard()
    {

        $expectedClassifications = ['NRP', 'Hors cible', 'RDV confirmé', 'RDV installé', 'Pas intéressé', 'RDV annulé', 'RDV à rappeler'];

        $fillMissingClassifications = function ($data) use ($expectedClassifications) {
            $result = array_fill_keys($expectedClassifications, 0);
            $result['Not Classified'] = 0; // Ensure "Not Classified" is included
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
    
        $rdvAuditData = RdvAudit::selectRaw("COALESCE(NULLIF(classification, ''), 'Not Classified') as classification, count(*) as total")
            ->groupBy('classification')
            ->get()
            ->pluck('total', 'classification');
    
        $totalRdvAudit = RdvAudit::count();
    
        // Fill missing classifications
        $rdvPanneauxData = $fillMissingClassifications($rdvPanneauxData->toArray());
        $rdvPompeData = $fillMissingClassifications($rdvPompeData->toArray());
        $rdvThermostatData = $fillMissingClassifications($rdvThermostatData->toArray());
        $rdvAuditData = $fillMissingClassifications($rdvAuditData->toArray());
    
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
            'rdvAudit' => [
                'classification_data' => $rdvAuditData,
                'total' => $totalRdvAudit,
            ],
        ];
        $agentStatistics = User::where('role', 'agent')
            ->withCount([
                'rdvPanneauxPhotovoltaiques as rdvPanneaux',
                'rdvPompeAChaleurs as rdvPompe',
                'rdvThermostats as rdvThermostat',
                'rdvAudits as rdvAudit'
            ])
            ->get()
            ->map(function ($agent) {
                return [
                    'agent_name' => $agent->name,
                    'rdvPanneaux' => $agent->rdvPanneaux ?? 0,
                    'rdvPompe' => $agent->rdvPompe ?? 0,
                    'rdvThermostat' => $agent->rdvThermostat ?? 0,
                    'rdvAudit' => $agent->rdvAudit ?? 0,
                ];
            });

        $partenaireStatistics = User::where('role', 'partenaire')
            ->withCount([
                'rdvPanneauxPhotovoltaiquesp as rdvPanneauxp',
                'rdvPompeAChaleursp as rdvPompep',
                'rdvThermostatsp as rdvThermostatp',
                'rdvAuditsp as rdvAudit'
            ])
            ->get()
            ->map(function ($partenaire) {
                return [
                    'partenaire_name' => $partenaire->name,
                    'rdvPanneaux' => $partenaire->rdvPanneauxp ?? 0,
                    'rdvPompe' => $partenaire->rdvPompep ?? 0,
                    'rdvThermostat' => $partenaire->rdvThermostatp ?? 0,
                    'rdvAudit' => $partenaire->rdvAudit ?? 0,
                ];
            });

        //   dd([
        //     'statistics' => $statistics,
        //    'agent_statistics' => $agentStatistics,
        //       "partenaire_statistics" => $partenaireStatistics
        //   ]);
        return view('superviseur/dashboard', compact("statistics", "agentStatistics", "partenaireStatistics"));
    }



    public function partenairedashboard()
{
    $user = Auth::user();
    $dateLimit = Carbon::now()->subDays(30);

    // Fonction pour compléter les classifications manquantes avec 0
    $expectedClassifications = ['NRP', 'Hors cible', 'RDV confirmé', 'RDV installé', 'Pas intéressé', 'RDV annulé', 'RDV à rappeler'];
    $fillMissingClassifications = function ($data) use ($expectedClassifications) {
        $result = array_fill_keys($expectedClassifications, 0);
        foreach ($data as $classification => $total) {
            $result[$classification] = $total;
        }
        return $result;
    };

    // Récupérer les données de rendez-vous pour chaque jour sur les 30 derniers jours
    $rdvDailyData = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
        ->where('created_at', '>=', $dateLimit)
        ->selectRaw("DATE(created_at) as date, count(*) as total")
        ->groupBy('date')
        ->get()
        ->pluck('total')
        ->toArray();

    $rdvPompeDailyData = RdvPompeAChaleur::where('partenaire_id', $user->id)
        ->where('created_at', '>=', $dateLimit)
        ->selectRaw("DATE(created_at) as date, count(*) as total")
        ->groupBy('date')
        ->get()
        ->pluck('total')
        ->toArray();

    $rdvThermostatDailyData = RdvThermostat::where('partenaire_id', $user->id)
        ->where('created_at', '>=', $dateLimit)
        ->selectRaw("DATE(created_at) as date, count(*) as total")
        ->groupBy('date')
        ->get()
        ->pluck('total')
        ->toArray();

    $rdvAuditDailyData = RdvAudit::where('partenaire_id', $user->id)
        ->where('created_at', '>=', $dateLimit)
        ->selectRaw("DATE(created_at) as date, count(*) as total")
        ->groupBy('date')
        ->get()
        ->pluck('total')
        ->toArray();

    // Compter les rendez-vous classifiés et non classifiés pour chaque type de RDV
    $classifiedRdvPanneaux = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
        ->whereNotNull('classification')
        ->count();
    $unclassifiedRdvPanneaux = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)
        ->whereNull('classification')
        ->count();

    $classifiedRdvPompe = RdvPompeAChaleur::where('partenaire_id', $user->id)
        ->whereNotNull('classification')
        ->count();
    $unclassifiedRdvPompe = RdvPompeAChaleur::where('partenaire_id', $user->id)
        ->whereNull('classification')
        ->count();

    $classifiedRdvThermostat = RdvThermostat::where('partenaire_id', $user->id)
        ->whereNotNull('classification')
        ->count();
    $unclassifiedRdvThermostat = RdvThermostat::where('partenaire_id', $user->id)
        ->whereNull('classification')
        ->count();

    $classifiedRdvAudit = RdvAudit::where('partenaire_id', $user->id)
        ->whereNotNull('classification')
        ->count();
    $unclassifiedRdvAudit = RdvAudit::where('partenaire_id', $user->id)
        ->whereNull('classification')
        ->count();

    // Calcul du nombre total de rendez-vous pour chaque type
    $totalRdvPanneaux = RdvPanneauxPhotovoltaique::where('partenaire_id', $user->id)->count();
    $totalRdvPompe = RdvPompeAChaleur::where('partenaire_id', $user->id)->count();
    $totalRdvThermostat = RdvThermostat::where('partenaire_id', $user->id)->count();
    $totalRdvAudit = RdvAudit::where('partenaire_id', $user->id)->count();

    // Ajout des statistiques
    $statistics = [
        'rdvPanneaux' => [
            'classification_data' => $fillMissingClassifications($rdvDailyData),
            'total' => array_sum($rdvDailyData),
            'daily' => $rdvDailyData,
            'classified' => $classifiedRdvPanneaux,
            'unclassified' => $unclassifiedRdvPanneaux,
            'overall_total' => $totalRdvPanneaux, // Nouveau total
        ],
        'rdvPompe' => [
            'classification_data' => $fillMissingClassifications($rdvPompeDailyData),
            'total' => array_sum($rdvPompeDailyData),
            'daily' => $rdvPompeDailyData,
            'classified' => $classifiedRdvPompe,
            'unclassified' => $unclassifiedRdvPompe,
            'overall_total' => $totalRdvPompe, // Nouveau total
        ],
        'rdvThermostat' => [
            'classification_data' => $fillMissingClassifications($rdvThermostatDailyData),
            'total' => array_sum($rdvThermostatDailyData),
            'daily' => $rdvThermostatDailyData,
            'classified' => $classifiedRdvThermostat,
            'unclassified' => $unclassifiedRdvThermostat,
            'overall_total' => $totalRdvThermostat, // Nouveau total
        ],
        'rdvAudit' => [
            'classification_data' => $fillMissingClassifications($rdvAuditDailyData),
            'total' => array_sum($rdvAuditDailyData),
            'daily' => $rdvAuditDailyData,
            'classified' => $classifiedRdvAudit,
            'unclassified' => $unclassifiedRdvAudit,
            'overall_total' => $totalRdvAudit, // Nouveau total
        ],
    ];

    return view('partenaire.dashboard', compact('statistics'));
}

        
}
