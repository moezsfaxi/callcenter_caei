<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AutorisationController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RdvAuditController;
use App\Http\Controllers\RdvPanneauxPhotovoltaiqueController;
use App\Http\Controllers\RdvPompeAChaleurController;
use App\Http\Controllers\RdvThermostatController;
use App\Http\Controllers\UserController;
use App\Models\Avance;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthenticatedSessionController::class, 'create'] )->name('first-page');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->name('posthome');


Route::get('/dashboard', function () { return view('dashboard');})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

});

Route::middleware(['auth','agent'])->group(function(){


// Demande d'autorisation and Demande d'avance

Route::get('/autorisation', [AutorisationController::class, 'index'])->name('autorisation.index');
Route::post('/autorisation', [AutorisationController::class, 'store'])->name('autorisation.store');

Route::get('/avance', [AvanceController::class, 'index'])->name('avance.index');
Route::post('/avance', [AvanceController::class, 'store'])->name('avance.store');



Route::get('/feed-agent',[PostController::class ,'agentpost'])->name('agent-post');
Route::get('agent/dashboard',[dashboardController::class ,'agentdashboard'] )->name('agent-dashboard-login');
Route::post('agent-rdv-panneaux-photovoltaique',[RdvPanneauxPhotovoltaiqueController::class ,'store'])->name('rdv-panneaux-photovoltaique.store');
Route::post('agent-rdv-audit',[RdvAuditController::class ,'store'])->name('rdv-audit.store');
Route::post('agent-rdv-pompe-a-chaleur',[RdvPompeAChaleurController::class,'store'])->name('rdv-pompe-a-chaleur.store');
Route::get('/rdv-thermostat/create', [RdvThermostatController::class, 'create'])->name('rdv.thermostat.create');
Route::post('agent-rdv-thermostat',[RdvThermostatController::class,'store'])->name('rdv-thermostat.store');
Route::get('/rdv-pompe-a-chaleur/agent', [RdvPompeAChaleurController::class, 'getRdvByAgent'])->name('rdv.PompeAChaleurAgent');
Route::get('/rdv-panneaux-photovoltaique/agent', [RdvPanneauxPhotovoltaiqueController::class, 'getRdvByAgent'])->name('rdv.PanneauxPhotovoltaiqueAgent');
Route::get('/rdv-audit/agent', [RdvAuditController::class, 'getRdvByAgent'])->name('rdv.auditAgent');
Route::get('/rdv-thermostat/agent', [RdvThermostatController::class, 'getRdvByAgent'])->name('rdv.ThermostatAgent');
Route::get('/rdv-pompe-a-chaleur/create', [RdvPompeAChaleurController::class, 'create'])->name('rdv.pompe-a-chaleur.create');
Route::get('/rdv-panneaux-photovoltaique/create', [RdvPanneauxPhotovoltaiqueController::class, 'create'])->name('rdv.panneaux-photovoltaique.create');
Route::get('/rdv-audit/create', [RdvAuditController::class, 'create'])->name('rdv.audit.create');

});
Route::middleware(['auth','partenaire'])->group(function(){
    Route::get('/feed-partenaire',[PostController::class ,'partenairepost'])->name('partenaire-post');
    Route::get('partenaire/dashboard',[dashboardController::class ,'partenairedashboard'] )->name('partenaire-dashboard-login');
    Route::put('/partenaire-rdv-panneaux-photovoltaique/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'update'])->name('rdv-panneaux-photovoltaique.update');
    Route::put('/partenaire-rdv-audit/{id}', [RdvAuditController::class, 'update'])->name('rdv-audit.update');


    Route::put('/partenaire-rdv-pompe-a-chaleur/{id}', [RdvPompeAChaleurController::class, 'update'])->name('rdv-pompe-a-chaleur.update');
    Route::put('/partenaire-rdv-thermostat/{id}', [RdvThermostatController::class, 'update'])->name('rdv-thermostat.update');
    Route::get('/rdv-thermostat/partenaire', [RdvThermostatController::class, 'getRdvForPartenaire'])->name('rdv.Thermostatpartenaire');
    Route::get('/rdv-pompe-a-chaleur/partenaire', [RdvPompeAChaleurController::class, 'getRdvForPartenaire'])->name('rdv.PompeAChaleurpartenaire');
    Route::get('/rdv-panneaux-photovoltaique/partenaire', [RdvPanneauxPhotovoltaiqueController::class, 'getRdvForPartenaire'])->name('rdv.PanneauxPhotovoltaiquepartenaire');
    Route::get('/rdv-audit/partenaire', [RdvAuditController::class, 'getRdvForPartenaire'])->name('rdv.auditpartenaire');

    Route::get('/rdv-panneaux-photovoltaique/partenaire/Qualifie', [RdvPanneauxPhotovoltaiqueController::class, 'getRdvForPartenaireQualified'])->name('rdv.QPanneauxPhotovoltaiquepartenaire');
    Route::get('/rdv-audit/partenaire/Qualifie', [RdvAuditController::class, 'getRdvForPartenaireQualified'])->name('rdv.Qauditpartenaire');


    Route::get('/partenaire/rdv-pompe-a-chaleur/qualifies', [RdvPompeAChaleurController::class, 'getRdvQualifiesForPartenaire'])->name('rdv.pompeachaleur.qualifies');
    Route::get('/partenaire/rdv-thermostat/qualifies', [RdvThermostatController::class, 'getRdvForPartenaireQualifier'])->name('rdv.thermostat.qualifies');
    Route::put('/rdv-thermostat/{id}/updatequalification', [RdvThermostatController::class, 'updatequalification'])->name('rdv-thermostat.updatequalification');
    Route::put('/rdv-panneaux-photovoltaique/{id}/updatequalification', [RdvPanneauxPhotovoltaiqueController::class, 'updatequalification'])->name('rdv-pv.updatequalification');
    Route::put('/rdv-audit/{id}/updatequalification', [RdvAuditController::class, 'updatequalification'])->name('rdv-audit.updatequalification');


    Route::put('/rdv-pompe-a-chaleur/{id}/updatequalification', [RdvPompeAChaleurController::class, 'updatequalification'])->name('rdv-pompe.updatequalification');
});

Route::middleware(['auth','superviseur'])->group(function(){
    Route::get('/feed-superviseur',[PostController::class ,'superviseurpost'])->name('superviseur-post');
    Route::get('superviseur/dashboard',[dashboardController::class ,'superviseurdashboard'] )->name('superviseur-dashboard-login');
    Route::put('/superviseur-rdv-panneaux-photovoltaique/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'assignrdv'])->name('rdv-panneaux-photovoltaique.assignrdv');
    Route::put('/superviseur-rdv-audit/{id}', [RdvAuditController::class, 'assignrdv'])->name('rdv-audit.assignrdv');


    Route::put('/superviseur-rdv-pompe-a-chaleur/{id}', [RdvPompeAChaleurController::class, 'assignrdv'])->name('rdv-pompe-a-chaleur.assignrdv');
    Route::put('/superviseur-rdv-thermostat/{id}', [RdvThermostatController::class, 'assignrdv'])->name('rdv-thermostat.assignrdv');
    Route::delete('/rdv-pompe-a-chaleur-superviseur/{id}', [RdvPompeAChaleurController::class, 'destroy'])->name('rdv-pompe-a-chaleur.destroy');
    Route::delete('/rdv-panneaux-photovoltaique-superviseur/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'destroy'])->name('rdv-panneaux-photovoltaique.destroy');
    Route::delete('/rdv-audit/{id}', [RdvAuditController::class, 'destroy'])->name('rdv-audit.destroy');


    Route::delete('/rdv-thermostat-superviseur/{id}', [RdvThermostatController::class, 'destroy'])->name('rdv-thermostat.destroy');
    Route::get('/all-superviseur-rdv-pompe-a-chaleur', [RdvPompeAChaleurController::class, 'index'])->name('superviseur-rdv-pompe-a-chaleur.index');
    Route::get('/all-superviseur-rdv-panneaux-photovoltaique', [RdvPanneauxPhotovoltaiqueController::class, 'index'])->name('superviseur-rdv-panneaux-photovoltaique.index');
    Route::get('/all-superviseur-rdv-audit', [RdvAuditController::class, 'index'])->name('superviseur-rdv-audit.index');


    Route::get('/all-superviseur-rdv-thermostat', [RdvThermostatController::class, 'index'])->name('superviseur-rdv-thermostat.index');
    Route::put('/rdv-thermostat/{id}', [RdvThermostatController::class, 'updaterdvThermostat'])->name('rdv.thermostat.update');
    Route::put('/rdv-pompe-a-chaleur/{id}', [RdvPompeAChaleurController::class, 'updateRdvPompeAChaleur'])->name('rdv.pompe-a-chaleur.update');
    Route::put('/rdv-panneaux/{id}', [RdvPanneauxPhotovoltaiqueController::class, 'updateRdvPanneau'])->name('rdv.panneaux.update');
    Route::put('/rdv-audit/{id}', [RdvAuditController::class, 'updateRdvPanneau'])->name('rdv.audit.update');

    //autorisation
    Route::get('/autorisation/superviseur', [AutorisationController::class, 'indexsuperviseur'])->name('autorisation.index-sup');
    Route::put('/autorisations/{id}/update-etat', [AutorisationController::class, 'updateEtat'])->name('autorisations.updateEtat');


    Route::get('/avance/superviseur', [AvanceController::class, 'indexsuperviseur'])->name('avance.index-sup');
    Route::put('/avance/{id}/update-etat', [AvanceController::class, 'updateEtat'])->name('avance.updateEtat');



});


Route::middleware(['auth','admin'])->group(function(){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('admin/create',[UserController::class ,'create'] )->name('create_users'); 
    Route::post('admin/createpost',[UserController::class ,'store'] )->name('create_users_store');        
    Route::get('/admin-dashboard',[dashboardController::class ,'admindashboard'] )->name('admin-dashboard-login');
    Route::get('/all-admin-rdv-pompe-a-chaleur',[RdvPompeAChaleurController::class, 'indexforadmin'])->name('admin-rdv-pompe-a-chaleur.index');
    Route::get('/all-admin-rdv-panneaux-photovoltaique',[RdvPanneauxPhotovoltaiqueController::class, 'indexforadmin'])->name('admin-rdv-panneaux-photovoltaique.index');
    Route::get('/all-admin-rdv-audit',[RdvAuditController::class, 'indexforadmin'])->name('admin-rdv-audit.index');


    Route::get('/all-admin-rdv-thermostat',[RdvThermostatController::class, 'indexforadmin'])->name('admin-rdv-thermostat.index');
    Route::get('/feed' ,[PostController::class  , 'create'] )->name('feed-admin');
    Route::get('/createpost',[PostController::class,'createpost'])->name('create-post-admin');
    Route::post('/sendpost' ,[PostController::class,'store'])->name('save-post-admin');
    Route::delete('/deletepost/{id}',[PostController::class , 'destroy'])->name('delete-post');
    Route::get('/posts/{id}/edit', [PostController::class, 'gotoeditview'])->name('edit-post');
    Route::put('/updatepost',[PostController::class,'update'])->name('update-post');
    
    Route::get('/autorisation/admin', [AutorisationController::class, 'indexadmin'])->name('autorisation.index-admin');
    Route::put('/autorisations/{id}/update-etatadmin', [AutorisationController::class, 'updateEtat'])->name('autorisations.updateEtatadmin');

    Route::get('/avance/admin', [AvanceController::class, 'indexadmin'])->name('avance.index-admin');
    Route::put('/avance/{id}/update-etatadmin', [AvanceController::class, 'updateEtat'])->name('avance.updateEtatadmin');


});

Route::get('/user/edit/{id}',[ProfileController::class,'edittheuser'])->name('user.edit-foryou');
Route::put('/user/edit/{id}',[ProfileController::class,'updateallusers'])->name('user.edit-every-field');

Route::post('/post/{postId}/comment', [PostController::class, 'commentstore'])->name('post.comment');
Route::post('/post/{postId}/like', [PostController::class, 'like'])->name('post.like');







require __DIR__.'/auth.php';


