<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RdvPanneauxPhotovoltaiqueController;
use App\Http\Controllers\RdvPompeAChaleurController;
use App\Http\Controllers\RdvThermostatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () { return view('dashboard');})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','agent'])->group(function(){

Route::get('agent/dashboard',[dashboardController::class ,'agentdashboard'] )->name('agent-dashboard-login');
Route::post('agent-rdv-panneaux-photovoltaique',[RdvPanneauxPhotovoltaiqueController::class ,'store'])->name('rdv-panneaux-photovoltaique.store');
Route::post('agent-rdv-pompe-a-chaleur',[RdvPompeAChaleurController::class,'store'])->name('rdv-pompe-a-chaleur.store');
Route::get('/rdv-thermostat/create', [RdvThermostatController::class, 'create'])->name('rdv.thermostat.create');
Route::post('agent-rdv-thermostat',[RdvThermostatController::class,'store'])->name('rdv-thermostat.store');
Route::get('/rdv-pompe-a-chaleur/agent', [RdvPompeAChaleurController::class, 'getRdvByAgent'])->name('rdv.PompeAChaleurAgent');
Route::get('/rdv-panneaux-photovoltaique/agent', [RdvPanneauxPhotovoltaiqueController::class, 'getRdvByAgent'])->name('rdv.PanneauxPhotovoltaiqueAgent');
Route::get('/rdv-thermostat/agent', [RdvThermostatController::class, 'getRdvByAgent'])->name('rdv.ThermostatAgent');
Route::get('/rdv-pompe-a-chaleur/create', [RdvPompeAChaleurController::class, 'create'])->name('rdv.pompe-a-chaleur.create');
Route::get('/rdv-panneaux-photovoltaique/create', [RdvPanneauxPhotovoltaiqueController::class, 'create'])->name('rdv.panneaux-photovoltaique.create');

});
Route::middleware(['auth','partenaire'])->group(function(){
    Route::get('partenaire/dashboard',[dashboardController::class ,'partenairedashboard'] )->name('partenaire-dashboard-login');
    Route::put('/partenaire-rdv-panneaux-photovoltaique/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'update'])->name('rdv-panneaux-photovoltaique.update');
    Route::put('/partenaire-rdv-pompe-a-chaleur/{id}', [RdvPompeAChaleurController::class, 'update'])->name('rdv-pompe-a-chaleur.update');
    Route::put('/partenaire-rdv-thermostat/{id}', [RdvThermostatController::class, 'update'])->name('rdv-thermostat.update');
    Route::get('/rdv-thermostat-classification/partenaire', [RdvThermostatController::class, 'getRdvForPartenaireclassification'])->name('rdv.Thermostatpartenaire-classification');
    Route::get('/rdv-pompe-a-chaleur-classification/partenaire', [RdvPompeAChaleurController::class, 'getRdvForPartenaireclassification'])->name('rdv.PompeAChaleurpartenaire-classification');
    Route::get('/rdv-panneaux-photovoltaique-classification/partenaire', [RdvPanneauxPhotovoltaiqueController::class, 'getRdvForPartenaireclassification'])->name('rdv.PanneauxPhotovoltaiquepartenaire-classification');
    Route::get('/rdv-thermostat-withoutclassification/partenaire', [RdvThermostatController::class, 'getRdvForPartenairewithoutclassification'])->name('rdv.Thermostatpartenaire-withoutclassification');
    Route::get('/rdv-pompe-a-chaleur-withoutclassification/partenaire', [RdvPompeAChaleurController::class, 'getRdvForPartenairewithoutclassification'])->name('rdv.PompeAChaleurpartenaire-withoutclassification');
    Route::get('/rdv-panneaux-photovoltaique-withoutclassification/partenaire', [RdvPanneauxPhotovoltaiqueController::class, 'getRdvForPartenairewithoutclassification'])->name('rdv.PanneauxPhotovoltaiquepartenaire-withoutclassification');

});

Route::middleware(['auth','superviseur'])->group(function(){
    Route::get('superviseur/dashboard',[dashboardController::class ,'superviseurdashboard'] )->name('superviseur-dashboard-login');
    Route::put('/superviseur-rdv-panneaux-photovoltaique/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'assignrdv'])->name('rdv-panneaux-photovoltaique.assignrdv');
    Route::put('/superviseur-rdv-pompe-a-chaleur/{id}', [RdvPompeAChaleurController::class, 'assignrdv'])->name('rdv-pompe-a-chaleur.assignrdv');
    Route::put('/superviseur-rdv-thermostat/{id}', [RdvThermostatController::class, 'assignrdv'])->name('rdv-thermostat.assignrdv');
    Route::delete('/rdv-pompe-a-chaleur-superviseur/{id}', [RdvPompeAChaleurController::class, 'destroy'])->name('rdv-pompe-a-chaleur.destroy');
    Route::delete('/rdv-panneaux-photovoltaique-superviseur/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'destroy'])->name('rdv-panneaux-photovoltaique.destroy');
    Route::delete('/rdv-thermostat-superviseur/{id}', [RdvThermostatController::class, 'destroy'])->name('rdv-thermostat.destroy');
    Route::get('/all-superviseur-rdv-pompe-a-chaleur', [RdvPompeAChaleurController::class, 'index'])->name('superviseur-rdv-pompe-a-chaleur.index');
    Route::get('/all-superviseur-rdv-panneaux-photovoltaique', [RdvPanneauxPhotovoltaiqueController::class, 'index'])->name('superviseur-rdv-panneaux-photovoltaique.index');
    Route::get('/all-superviseur-rdv-thermostat', [RdvThermostatController::class, 'index'])->name('superviseur-rdv-thermostat.index');

});


Route::middleware(['auth','admin'])->group(function(){
    Route::get('/admin-dashboard',[dashboardController::class ,'admindashboard'] )->name('admin-dashboard-login');
    Route::get('/all-admin-rdv-pompe-a-chaleur', [RdvPompeAChaleurController::class, 'index'])->name('admin-rdv-pompe-a-chaleur.index');
    Route::get('/all-admin-rdv-panneaux-photovoltaique', [RdvPanneauxPhotovoltaiqueController::class, 'index'])->name('admin-rdv-panneaux-photovoltaique.index');
    Route::get('/all-admin-rdv-thermostat', [RdvThermostatController::class, 'index'])->name('admin-rdv-thermostat.index');
});






require __DIR__.'/auth.php';
