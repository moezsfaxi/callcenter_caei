@extends('admin.test')

@section('content')
@section('content')
    <div class="container mt-1">
        <h1 class="text-center">Tableau de Bord Administrateur</h1>
        <h1 class="text-center">   </h1>

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

            <div class=" w-full bg-white rounded shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class=" rounded-lg bg-gray-100 dark:bg-gray-700 flex   justify-center me-3">
                            <h5 class="text-2xl font-bold text-gray-900 dark:text-white pb-1">Statistiques Des RDVs :</h5>
                        </div>
                        <div>
                            <h5 class="text-2xl font-bold text-gray-900 dark:text-white pb-1"></h5>
                            <p class="text-sm font-normal text-gray-500 dark:text-gray-400"></p>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-2">
                    <dl class="flex items-center">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1"> </dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold"> </dd>
                    </dl>
                    <dl class="flex items-center justify-end">
                        <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1"> </dt>
                        <dd class="text-gray-900 text-sm dark:text-white font-semibold"> </dd>
                    </dl>
                </div>

                <div id="column-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <!-- Button -->

                        <!-- Dropdown menu -->


                    </div>
                </div>
            </div>
            <script>
                // Obtenez les données des rendez-vous quotidiens pour chaque type
                var dailyRdvThermostatData = @json($dailyRdvThermostatData);
                var dailyRdvPanneauxData = @json($dailyRdvPanneauxData);
                var dailyRdvPompeData = @json($dailyRdvPompeData);
                var dailyRdvAuditData = @json($dailyRdvAuditData);
            
                // Préparez les jours en tant qu'axe x (sous forme de tableau)
                var days = Object.keys(dailyRdvThermostatData).concat(
                                Object.keys(dailyRdvPanneauxData),
                                Object.keys(dailyRdvPompeData),
                                Object.keys(dailyRdvAuditData)
                            ).filter((value, index, self) => self.indexOf(value) === index).sort();
            
                // Préparez les données pour chaque type de RDV
                var thermostatSeries = days.map(day => ({ x: day, y: dailyRdvThermostatData[day] || 0 }));
                var panneauxSeries = days.map(day => ({ x: day, y: dailyRdvPanneauxData[day] || 0 }));
                var pompeSeries = days.map(day => ({ x: day, y: dailyRdvPompeData[day] || 0 }));
                var auditSeries = days.map(day => ({ x: day, y: dailyRdvAuditData[day] || 0 }));
            
                document.addEventListener("DOMContentLoaded", function() {
                    const options = {
                        chart: {
                            type: "bar",
                            height: "320px",
                            fontFamily: "Inter, sans-serif",
                            toolbar: { show: false },
                        },
                        colors: ["#FCFE19", "#24D26D", "#87CEEB"],
                        series: [
                            {
                                name: "Pompe",
                                color: "#FCFE19",
                                data: pompeSeries
                            },
                            {
                                name: "Thermostat",
                                color: "#24D26D",
                                data: thermostatSeries
                            },
                            {
                                name: "Panneaux",
                                color: "#87CEEB",
                                data: panneauxSeries
                            },
                            {
                                name: "Audit",
                                color: "#fe2419",
                                data: auditSeries
                            },
                        ],
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
                            style: {
                                fontFamily: "Inter, sans-serif",
                            },
                        },
                        states: {
                            hover: {
                                filter: {
                                    type: "darken",
                                    value: 1,
                                },
                            },
                        },
                        stroke: {
                            show: true,
                            width: 0,
                            colors: ["transparent"],
                        },
                        grid: {
                            show: false,
                            strokeDashArray: 2,
                            padding: {
                                left: 2,
                                right: 2,
                                top: -14
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        legend: {
                            show: true,
                        },
                        xaxis: {
                            categories: days,
                            floating: false,
                            labels: {
                                show: true,
                                style: {
                                    fontFamily: "Inter, sans-serif",
                                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                }
                            },
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                        },
                        yaxis: {
                            show: true,
                        },
                        fill: {
                            opacity: 1,
                        },
                    };
                    
                    if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                        const chart = new ApexCharts(document.getElementById("column-chart"), options);
                        chart.render();
                    }
                });
            </script>
            
            

            {{-- //Statistiques pompe à chaleur// --}}


            <div class="container mt-5 shadow rounded">
                <h1 class="text-center mb-4 rounded">Statistiques des RDVs par Partenaire</h1>

                <table class="table table-striped table-bordered table-hover rounded">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>Partenaire</th>
                            <th>RDVs Thermostat</th>
                            <th>RDVs Panneaux Photovoltaïques</th>
                            <th>RDVs Pompe à Chaleur</th>
                            <th>RDVs Audit </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partenaireStatistics as $partenaire)
                            <tr>
                                <td>{{ $partenaire['partenaire_name'] }}</td>
                                <td>{{ $partenaire['rdvThermostat'] }} RDV</td>
                                <td>{{ $partenaire['rdvPanneaux'] }} RDV</td>
                                <td>{{ $partenaire['rdvPompe'] }} RDV</td>
                                <td>{{ $partenaire['rdvAudit'] }} RDV</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="container mt-5 shadow rounded">
                <h1 class="text-center mb-4 rounded">Statistiques des RDVs par Agent</h1>

                <table class="table table-striped table-bordered table-hover rounded">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th>Agent</th>
                            <th>RDVs Thermostat</th>
                            <th>RDVs Panneaux Photovoltaïques</th>
                            <th>RDVs Pompe à Chaleur</th>
                            <th>RDVs  Audit </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agentStatistics as $agent)
                            <tr>
                                <td>{{ $agent['agent_name'] }}</td>
                                <td>{{ $agent['rdvThermostat'] }} RDV</td>
                                <td>{{ $agent['rdvPanneaux'] }} RDV</td>
                                <td>{{ $agent['rdvPompe'] }} RDV</td>
                                <td>{{ $agent['rdvAudit'] }} RDV</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
            <script src="{{ asset('tailwindcharts/js/flowbite.min.js') }}"></script>

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
                color: #4a8ac9;
                /* Couleur différente pour le second titre */
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
                border-left: 5px solid #FCFE19;
            }
            .audit-box {
            border-left: 7px solid #fe2419;
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

            /* Specific styles for each qualification */
            .nrp-box {
                border-left: 10px solid red;
            }

            .hc-box {
                border-left: 10px solid #8B0000;
            }

            /* Rouge Bordeaux */
            .confirme-box {
                border-left: 10px solid #266c1e;
            }

            /* Vert */
            .unjoignable-box {
                border-left: 10px solid orange;
            }

            .installe-box {
                border-left: 10px solid #24D26D;
            }

            /* Vert */
            .annule-box {
                border-left: 10px solid #ffff00;
            }

            .pas-interesse-box {
                border-left: 10px solid #0594D0;
            }

            /* Bleu Ciel */

            /* Responsive Design */
            @media (max-width: 768px) {
                .qual-box {
                    margin-bottom: 20px;
                }
            }

            .table {
                background-color: #f9f9f9;
                border-radius: 25px;
            }

            .table thead {
                background-color: hsl(210, 48%, 67%);
                color: #fff;
                padding: 15px;
                border: 2px solid#4a8ac9;
                border-radius: 5px;
                font-weight: bold;
            }

            .table th {
                background-color: #4a8ac9;
                color: #fff;
                padding: 15px;
                font-weight: bold;
            }

            .table td {
                padding: 10px;
                text-align: center;
                vertical-align: middle;
                border-radius: 25px;
            }

            .table-hover tbody tr:hover {
                background-color: #ffff00;
                /* Correction ici : suppression des accolades */
            }

            h1 {
                font-size: 2.5rem;
                color: #000000;
                text-transform: uppercase;
                font-weight: bold;
                text-shadow: 2px 2px 4px #cec9c9;
            }
        </style>
    @endsection
