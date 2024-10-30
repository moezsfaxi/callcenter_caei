@extends('partenaire.test')

@section('content')
    <div class="container mt-1">
        <h1 class="text-center">Bienvenue dans Votre Espace</h1>
        {{-- <h1 class="text-center">{{ $partenaire->name }} {{ $partenaire->last_name }}</h1> --}}


        <div class="row text-center mb-6 stats-section">
            <div class="col-md-4">
                <div class="stat-box thermostat-box shadow">
                    <h3>Thermostat</h3>
                    <p class="stat-number">{{ $statistics['rdvThermostat']['overall_total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box panneaux-box shadow">
                    <h3>Panneaux Photovoltaïques</h3>
                    <p class="stat-number">{{ $statistics['rdvPanneaux']['overall_total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-box pompe-box shadow">
                    <h3>Pompe à Chaleur</h3>
                    <p class="stat-number">{{ $statistics['rdvPompe']['overall_total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="col-md-4">
                <div class="stat-box audit-box shadow d-flex flex-column align-items-center justify-content-center" style="height: 100%; text-align: center;">
                    <h3>Audit</h3>
                    <p class="stat-number">{{ $statistics['rdvAudit']['overall_total'] }}</p>
                    <p>RDV Totales</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-1 w-full bg-white rounded-lg shadow dark:bg-gray-800  ">
        <h4 class="text-gray-700 dark:text-gray-300 font-bold mb-4">Statistiques des Rendez-vous</h4>

        <div class="grid grid-cols-3 gap-6 mb-4  ">
            <!-- RDV Panneaux -->
            <div class="p-5 bg-gray-100 rounded-lg qual-box nrp-box">
                <h5 class="font-bold text-gray-800">Panneaux Photovoltaïques</h5>
                <p>Qualifiés :<span class="qual-number"> {{ $statistics['rdvPanneaux']['classified'] }}</span></p>
                <p>Non Qualifiés :<span class="qual-number"> {{ $statistics['rdvPanneaux']['unclassified'] }}</span></p>
            </div>

            <!-- RDV Pompe à Chaleur -->
            <div class="p-4 bg-gray-100 rounded-lg qual-box nrp-box">
                <h5 class="font-bold text-gray-800">Pompe à Chaleur</h5>
                <p>Qualifiés : <span class="qual-number">{{ $statistics['rdvPompe']['classified'] }}</span></p>
                <p>Non Qualifiés : <span class="qual-number">{{ $statistics['rdvPompe']['unclassified'] }}</span></p>
            </div>

            <!-- RDV Thermostat -->
            <div class="p-4 bg-gray-100 rounded-lg qual-box nrp-box">
                <h5 class="font-bold text-gray-800">Thermostat</h5>
                <p>Qualifiés : <span class="qual-number">{{ $statistics['rdvThermostat']['classified'] }}</span></p>
                <p>Non Qualifiés : <span class="qual-number">{{ $statistics['rdvThermostat']['unclassified'] }}</span></p>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg qual-box nrp-box">
                <h5 class="font-bold text-gray-800">Audit</h5>
                <p>Qualifiés : <span class="qual-number">{{ $statistics['rdvAudit']['classified'] }}</span></p>
                <p>Non Qualifiés : <span class="qual-number">{{ $statistics['rdvAudit']['unclassified'] }}</span></p>
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
        <div class="container-fluid mt-1 w-full bg-white rounded-lg shadow dark:bg-gray-800">
            <h4 class="text-gray-700 dark:text-gray-300 font-bold mb-4">Nombre de RDVs par Jour </h4>
            <div id="daily-rdv-chart" class="h-96"></div>
        </div>

        <script>
            const dailyDates = {!! json_encode(array_keys($statistics['rdvPanneaux']['daily'])) !!};
            const panneauxData = {!! json_encode(array_values($statistics['rdvPanneaux']['daily'])) !!};
            const pompeData = {!! json_encode(array_values($statistics['rdvPompe']['daily'])) !!};
            const thermostatData = {!! json_encode(array_values($statistics['rdvThermostat']['daily'])) !!};
            const auditData = {!! json_encode(array_values($statistics['rdvAudit']['daily'])) !!};
           

            const options = {
                chart: {
                    type: "line",
                    height: "300",
                    fontFamily: "Inter, sans-serif",
                    toolbar: {
                        show: false
                    },
                },
                series: [{
                        name: "Thermostat",
                        data: thermostatData,
                        color: "#24D26D"
                    },
                    {
                        name: "Pompe à Chaleur",
                        data: pompeData,
                        color: "#FCFE19"
                    },
                    {
                        name: "Panneaux Photovoltaïques",
                        data: panneauxData,
                        color: "#0594D0"
                    },
                    {
                        name: "Audit",
                        data: auditData,
                        color: "#fe2419"
                    },
                     
                ],
                xaxis: {
                    categories: dailyDates,
                    labels: {
                        style: {
                            fontFamily: "Inter, sans-serif"
                        }
                    },
                    title: {
                        text: 'Date'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Nombre de RDVs'
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4
                },
                legend: {
                    show: true
                }
            };

            if (document.getElementById("daily-rdv-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("daily-rdv-chart"), options);
                chart.render();
            }
        </script>
    </body>
    <script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
    <script src="{{ asset('tailwindcharts/js/flowbite.min.js') }}"></script>

    </html>


    <style>
        h1.text-center {
            font-family: 'Arial', sans-serif;

            color: #111224;

            font-size: 26px;

            font-weight: bold;

            text-align: center;

            margin-top: 20px;

            margin-bottom: 20px;

        }


        h1.text-center:first-of-type {
            color: #111224;

        }

        h1.text-center:last-of-type {
            color: #482986;

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


        .thermostat-box {
            border-left: 7px solid #24D26D;
        }

        .panneaux-box {
            border-left: 7px solid #0594D0;
        }

        .pompe-box {
            border-left: 7px solid #FCFE19;
        }

        .audit-box {
            border-left: 7px solid #fe2419;
        }


        @media (max-width: 768px) {
            .stat-box {
                margin-bottom: 20px;
            }
        }

        .qualification-section {
            margin-top: 15px;
            margin-left: 220px;
        }

        .qual-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            margin: 15px 0;
            transition: all 0.3s ease;
        }

        .qual-box h4 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .qual-number {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
        }

        .qual-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


        .nrp-box {
            border-left: 10px solid #9d1e1e;
            border-right: 10px solid #9d1e1e;
        }

        .hc-box {
            border-left: 10px solid #8A97FE;
            border-right: 10px solid #8A97FE;
        }

      
        @media (max-width: 768px) {
            .qual-box {
                margin-bottom: 20px;
            }
        }
    </style>

    <!-- JavaScript to Render Chart -->
@endsection
