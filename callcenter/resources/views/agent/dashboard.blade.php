@extends('agent.test')

@section('content')
    <div class="container mt-1">
        <h1 class="text-center">Bienvenue dans votre espace </h1>
        {{-- <h1 class="text-center">"{{ $agent->name }} {{ $agent->last_name }}"</h1> --}}

        <!-- Statistiques en colonnes -->
        <div class="row text-center mb-5 stats-section">
            <div class="col-md-4">
                <div class="stat-box thermostat-box shadow">
                    <h3>Thermostat</h3>
                    <p class="stat-number">{{ $statistics['rdvThermostat']['total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box panneaux-box shadow">
                    <h3>Panneaux Photovoltaïques</h3>
                    <p class="stat-number">{{ $statistics['rdvPanneaux']['total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box pompe-box shadow">
                    <h3>Pompe à Chaleur</h3>
                    <p class="stat-number">{{ $statistics['rdvPompe']['total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-4">
                    <div class="stat-box audit-box shadow d-flex flex-column align-items-center justify-content-center" style="height: 100%; text-align: center;">
                        <h3>Audit</h3>
                        <p class="stat-number">{{ $statistics['rdvAudit']['total'] }}</p>
                        <p>RDV Totales</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4 shadow rounded rdvPanneaux">
            <h2 class="text-center stat-t shadow">Qualifications des Panneaux Photovoltaïques</h2>
            <div class="row text-center mb-4 qualification-section">
                <div class="col-md-2">
                    <div class="qual-box shadow nrp-box">
                        <h4>NRP</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['NRP'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow hc-box">
                        <h4>Hors cible</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['Hors cible'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow confirme-box">
                        <h4>RDV confirmé</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['RDV confirmé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow installe-box">
                        <h4>RDV installé</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['RDV installé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow pas-interesse-box">
                        <h4>Pas interessé</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['Pas intéressé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow annule-box">
                        <h4>RDV annulé</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['RDV annulé'] }}</p>
                    </div>
                </div>
                 
                <div class="col-md-2">
                    <div class="qual-box shadow rappel-box">
                        <h4>RDV à rappeler</h4>
                        <p class="qual-number">{{ $statistics['rdvPanneaux']['classification_data']['RDV à rappeler'] }}</p>
                    </div>
                </div>
                <!-- Repeat for each classification with its corresponding value -->
            </div>
        </div>
        
        <div class="container mt-4 shadow rounded rdvPompe">
            <h2 class="text-center stat-t shadow">Qualifications des Pompes à chaleur</h2>
            <div class="row text-center mb-4 qualification-section">
                <div class="col-md-2">
                    <div class="qual-box shadow nrp-box">
                        <h4>NRP</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['NRP'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow hc-box">
                        <h4>Hors cible</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['Hors cible'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow confirme-box">
                        <h4>RDV confirmé</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['RDV confirmé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow installe-box">
                        <h4>RDV installé</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['RDV installé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow pas-interesse-box">
                        <h4>RDV pas interessé</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['Pas intéressé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow annule-box">
                        <h4>RDV annulé</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['RDV annulé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow rap-box">
                        <h4>RDV à rappeler</h4>
                        <p class="qual-number">{{ $statistics['rdvPompe']['classification_data']['RDV à rappeler'] }}</p>
                    </div>
                </div>
                <!-- Repeat for each classification with its corresponding value -->
            </div>
        </div>
        
        <div class="container mt-4 shadow rounded rdvThermostat">
            <h2 class="text-center stat-t shadow">Qualifications des Thermostats</h2>
            <div class="row text-center mb-4 qualification-section">
                <div class="col-md-2">
                    <div class="qual-box shadow nrp-box">
                        <h4>NRP</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['NRP'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow hc-box">
                        <h4>Hors cible</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['Hors cible'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow confirme-box">
                        <h4>RDV confirmé</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['RDV confirmé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow installe-box">
                        <h4>RDV installé</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['RDV installé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow pas-intersse-box">
                        <h4>RDV pas interssé</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['Pas intéressé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow annule-box">
                        <h4>RDV annulé</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['RDV annulé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow rappel-box">
                        <h4>RDV à rappelé</h4>
                        <p class="qual-number">{{ $statistics['rdvThermostat']['classification_data']['RDV à rappeler'] }}</p>
                    </div>
                </div>
                <!-- Repeat for each classification with its corresponding value -->
            </div>
        </div>
        <div class="container mt-4 shadow rounded rdvThermostat">
            <h2 class="text-center stat-t shadow">Qualifications des Audits</h2>
            <div class="row text-center mb-4 qualification-section">
                <div class="col-md-2">
                    <div class="qual-box shadow nrp-box">
                        <h4>NRP</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['NRP'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow hc-box">
                        <h4>Hors cible</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['Hors cible'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow confirme-box">
                        <h4>RDV confirmé</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['RDV confirmé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow installe-box">
                        <h4>RDV installé</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['RDV installé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow pas-intersse-box">
                        <h4>RDV pas interssé</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['Pas intéressé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow annule-box">
                        <h4>RDV annulé</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['RDV annulé'] }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="qual-box shadow rappel-box">
                        <h4>RDV à rappelé</h4>
                        <p class="qual-number">{{ $statistics['rdvAudit']['classification_data']['RDV à rappeler'] }}</p>
                    </div>
                </div>
                <!-- Repeat for each classification with its corresponding value -->
            </div>
        </div>
        


        {{-- <!-- Derniers 6 mois - Classification limitée -->
        <div class="container mt-4 shadow rounded">
            <h2 class="text-center stat-t shadow">Données des 6 derniers mois</h2>
            @foreach ($statistics['lastSixMonths'] as $month => $data)
                <div class="month-data mt-3">
                    <h3>{{ $month }}</h3>
                    <div class="row text-center mb-4">
                        @foreach ($data as $classification => $count)
                            <div class="col-md-2">
                                <div class="qual-box shadow {{ strtolower(str_replace(' ', '-', $classification)) }}-box">
                                    <h4>{{ $classification }}</h4>
                                    <p class="qual-number">{{ $count }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('tailwindcharts/css/flowbite.min.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>

    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="rounded-lg bg-gray-100 dark:bg-gray-700 flex justify-center me-3">
                    <h5 class="text-2xl font-bold text-gray-900 dark:text-white pb-1">Performances Agent Thermostat</h5>
                </div>
            </div>
        </div>

        <div id="thermostat-chart"></div>
    </div>

    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="rounded-lg bg-gray-100 dark:bg-gray-700 flex justify-center me-3">
                    <h5 class="text-2xl font-bold text-gray-900 dark:text-white pb-1">Performances Agent Pompe à Chaleur</h5>
                </div>
            </div>
        </div>

        <div id="pompe-chart"></div>
    </div>
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="rounded-lg bg-gray-100 dark:bg-gray-700 flex justify-center me-3">
                    <h5 class="text-2xl font-bold text-gray-900 dark:text-white pb-1">Performances Agent Panneaux</h5>
                </div>
            </div>
        </div>

        <div id="panneaux-chart"></div>
    </div>
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="rounded-lg bg-gray-100 dark:bg-gray-700 flex justify-center me-3">
                    <h5 class="text-2xl font-bold text-gray-900 dark:text-white pb-1">Performances Agent Audit</h5>
                </div>
            </div>
        </div>

        <div id="audit-chart"></div>
    </div>

    <script>
        // Récupérer les données des statistiques par mois pour Thermostat
        const lastTwoMonthsData = @json($statistics['lastTwoMonths']);
        const months = Object.keys(lastTwoMonthsData).reverse(); // Inverser l'ordre
    
        const rdvConfirmeThermostatData = months.map(month => lastTwoMonthsData[month]['thermostat']['RDV confirmé']);
        const rdvAnnuleThermostatData = months.map(month => lastTwoMonthsData[month]['thermostat']['RDV annulé']);
        const horsCibleThermostatData = months.map(month => lastTwoMonthsData[month]['thermostat']['Hors cible']);
    
        const thermostatSeriesData = [
            {
                name: "RDV confirmé",
                data: rdvConfirmeThermostatData,
                color: "#266c1e" // Vert
            },
            {
                name: "RDV annulé",
                data: rdvAnnuleThermostatData,
                color: "#FFFF00"
            },
            {
                name: "Hors cible",
                data: horsCibleThermostatData,
                color: "#8B0000"
            }
        ];
    
        const thermostatOptions = {
            series: thermostatSeriesData,
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            xaxis: {
                categories: months,
                title: {
                    text: 'Mois',
                },
            },
            yaxis: {
                title: {
                    text: 'Nombre de Rendez-vous',
                },
            },
        };
    
        if (document.getElementById("thermostat-chart") && typeof ApexCharts !== 'undefined') {
            const thermostatChart = new ApexCharts(document.getElementById("thermostat-chart"), thermostatOptions);
            thermostatChart.render();
        }
    
        // Répéter le même processus pour Pompe à Chaleur
        const rdvConfirmePompeData = months.map(month => lastTwoMonthsData[month]['pompe']['RDV confirmé']);
        const rdvAnnulePompeData = months.map(month => lastTwoMonthsData[month]['pompe']['RDV annulé']);
        const horsCiblePompeData = months.map(month => lastTwoMonthsData[month]['pompe']['Hors cible']);
    
        const pompeSeriesData = [
            {
                name: "RDV confirmé",
                data: rdvConfirmePompeData,
                color: "#266c1e" // Vert
            },
            {
                name: "RDV annulé",
                data: rdvAnnulePompeData,
                color: "#FFFF00" // Rouge
            },
            {
                name: "Hors cible",
                data: horsCiblePompeData,
                color: "#8B0000"
            }
        ];
    
        const pompeOptions = {
            series: pompeSeriesData,
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            xaxis: {
                categories: months,
                title: {
                    text: 'Mois',
                },
            },
            yaxis: {
                title: {
                    text: 'Nombre de Rendez-vous',
                },
            },
        };
    
        if (document.getElementById("pompe-chart") && typeof ApexCharts !== 'undefined') {
            const pompeChart = new ApexCharts(document.getElementById("pompe-chart"), pompeOptions);
            pompeChart.render();
        }
    
        // Répéter le même processus pour Panneaux
        const rdvConfirmePanneauxData = months.map(month => lastTwoMonthsData[month]['panneaux']['RDV confirmé']);
        const rdvAnnulePanneauxData = months.map(month => lastTwoMonthsData[month]['panneaux']['RDV annulé']);
        const horsCiblePanneauxData = months.map(month => lastTwoMonthsData[month]['panneaux']['Hors cible']);
    
        const panneauxSeriesData = [
            {
                name: "RDV confirmé",
                data: rdvConfirmePanneauxData,
                color: "#266c1e"
            },
            {
                name: "RDV annulé",
                data: rdvAnnulePanneauxData,
                color: "#FFFF00"
            },
            {
                name: "Hors cible",
                data: horsCiblePanneauxData,
                color: "#8B0000"
            }
        ];
    
        const panneauxOptions = {
            series: panneauxSeriesData,
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            xaxis: {
                categories: months,
                title: {
                    text: 'Mois',
                },
            },
            yaxis: {
                title: {
                    text: 'Nombre de Rendez-vous',
                },
            },
        };
    
        if (document.getElementById("panneaux-chart") && typeof ApexCharts !== 'undefined') {
            const panneauxChart = new ApexCharts(document.getElementById("panneaux-chart"), panneauxOptions);
            panneauxChart.render();
        }
    
        // Répéter le même processus pour Audit
        const rdvConfirmeAuditData = months.map(month => lastTwoMonthsData[month]['audit']['RDV confirmé']);
        const rdvAnnuleAuditData = months.map(month => lastTwoMonthsData[month]['audit']['RDV annulé']);
        const horsCibleAuditData = months.map(month => lastTwoMonthsData[month]['audit']['Hors cible']);
    
        const auditSeriesData = [
            {
                name: "RDV confirmé",
                data: rdvConfirmeAuditData,
                color: "#266c1e"
            },
            {
                name: "RDV annulé",
                data: rdvAnnuleAuditData,
                color: "#FFFF00"
            },
            {
                name: "Hors cible",
                data: horsCibleAuditData,
                color: "#8B0000"
            }
        ];
    
        const auditOptions = {
            series: auditSeriesData,
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: { show: false },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 8,
                },
            },
            tooltip: {
                shared: true,
                intersect: false,
            },
            xaxis: {
                categories: months,
                title: {
                    text: 'Mois',
                },
            },
            yaxis: {
                title: {
                    text: 'Nombre de Rendez-vous',
                },
            },
        };
    
        if (document.getElementById("audit-chart") && typeof ApexCharts !== 'undefined') {
            const auditChart = new ApexCharts(document.getElementById("audit-chart"), auditOptions);
            auditChart.render();
        }
    </script>
    
    <script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
    <script src="{{ asset('tailwindcharts/js/flowbite.min.js') }}"></script>

</body>
</html>

    <!-- Section pour les graphiques -->

    <!-- Custom Styling for Statistics Section -->
    <style>
        h1.text-center {
            font-family: 'Arial', sans-serif;
            /* Change la police */
            color: #111224;
            /* Couleur du texte */
            font-size: 26px;
            /* Taille de la police */
            font-weight: bold;
            /* Rend le texte en gras */
            text-align: center;
            /* Centre le texte */
            margin-top: 20px;
            /* Ajoute un espace au-dessus */
            margin-bottom: 20px;
            /* Ajoute un espace en dessous */
        }

        /* Si tu veux styliser chaque titre différemment */
        h1.text-center:first-of-type {
            color: #111224;
            /* Couleur différente pour le premier titre */
        }

        h1.text-center:last-of-type {
            color: #482986;
            /* Couleur différente pour le second titre */
        }

        .stat-t {
            border-radius: 5px;
            border: 2px solid rgb(226, 217, 229);

            text-align: center;

            line-height: 30px;
        }

        .stats-section {
            margin-top: 30px;
        }

        .stat-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin: 10px 0;
            transition: all 0.3s ease;
        }

        .stat-box h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Specific styles for each section */
        .thermostat-box {
            border-left: 5px solid #24D26D;
        }

        .panneaux-box {
            border-left: 5px solid #0594D0;
        }

        .pompe-box {
            border-left: 5px solid #E0FF20;
        }
       
        .audit-box {
            border-left: 5px solid #fe2419;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stat-box {
                margin-bottom: 20px;
            }
        }

        .qualification-section {
            margin-top: 30px;
        }

        .qual-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            transition: all 0.3s ease;
        }

        .qual-box h4 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .qual-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }

        .qual-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Thermostat */
       /* Thermostat Qualifications */
.rdvThermostat .qual-box.nrp-box {
    border-left: 10px solid #ff1717; /* Rouge Tomate */
}
.rdvThermostat .qual-box.hc-box {
    border-left: 10px solid #8B0000; /* Rouge Bordeaux */
}
.rdvThermostat .qual-box.confirme-box {
    border-left: 10px solid #266c1e; /* Vert Foncé */
}

.rdvThermostat .qual-box.installe-box {
    border-left: 10px solid #32CD32; /* Vert Citron */
}
.rdvThermostat .qual-box.pas-intersse-box {
    border-left: 10px solid rgb(0, 149, 255); /* Orange */
}

.rdvThermostat .qual-box.annule-box {
    border-left: 10px solid #FFD700; /* Jaune Or */
}
.rdvThermostat .qual-box.rappel-box {
    border-left: 10px solid orange; /* Orange */
}
 
/* Panneaux Photovoltaïques Qualifications */
.rdvPanneaux .qual-box.nrp-box {
    border-left: 10px solid #ff0000;  
}
.rdvPanneaux .qual-box.hc-box {
    border-left: 10px solid #8B0000;  
}
.rdvPanneaux .qual-box.confirme-box {
    border-left: 10px solid #228B22;  
}
.rdvPanneaux .qual-box.installe-box {
    border-left: 10px solid #32CD32; /* Vert Lime */
}
.rdvPanneaux .qual-box.pas-interesse-box {
    border-left: 10px solid #4682B4; /* Bleu Acier */
}

.rdvPanneaux .qual-box.annule-box {
    border-left: 10px solid #FFFF00; /* Jaune */
}
.rdvPanneaux .qual-box.rappel-box{
    border-left: 10px solid orange; /* Orange */
}

/* Pompes à chaleur Qualifications */
.rdvPompe .qual-box.nrp-box {
    border-left: 10px solid #ff1717; /* Crème */
}
.rdvPompe .qual-box.hc-box {
    border-left: 10px solid #8B0000; /* Rouge Bordeaux */
}
.rdvPompe .qual-box.confirme-box {
    border-left: 10px solid #006400; /* Vert Sombre */
}
 
.rdvPompe .qual-box.installe-box {
    border-left: 10px solid #32CD32; /* Vert */
}
.rdvPompe .qual-box.pas-interesse-box {
    border-left: 10px solid #4682B4; /* Bleu Acier */
}
.rdvPompe .qual-box.annule-box {
    border-left: 10px solid #FFFF00;  /* Jaune Pale */
}
.rdvPompe .qual-box.rap-box {
    border-left: 10px solid orange; /* Orange */
}

/* Responsive Design */
@media (max-width: 768px) {
    .qual-box {
        margin-bottom: 20px;
    }
}

    </style>
@endsection
