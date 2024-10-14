<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    
    public function agentdashboard()
    {
        return view('agent.dashboard');
    }
    public function admindashboard()
    {
        return view('admin.dashboard');
    }
    public function superviseurdashboard()
    {
        return view('superviseur.dashboard');
    }
    public function partenairedashboard()
    {
        return view('partenaire.dashboard');
    }



}
