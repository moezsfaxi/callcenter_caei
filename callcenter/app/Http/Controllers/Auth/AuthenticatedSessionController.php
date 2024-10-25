<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        $user = Auth::user();

if ($user) {
    $role = $user->role;
    switch ($role) {
        case 'agent':
            return redirect()->route('agent-dashboard-login');
            
        case 'admin':
            return redirect()->route('admin-dashboard-login');
         
        case 'partenaire':
            return redirect()->route('partenaire-dashboard-login');
       
        case 'superviseur':
            return redirect()->route('superviseur-dashboard-login');
          
        default:
      
            return redirect()->route('first-page');
    }}
     else {
    return view('auth.login');
    }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = $request->user();

        $role = $user->role;


        switch ($role) {
            case 'agent':
                return redirect()->route('agent-dashboard-login');
                
            case 'admin':
                return redirect()->route('admin-dashboard-login');
             
            case 'partenaire':
                return redirect()->route('partenaire-dashboard-login');
           
            case 'superviseur':
                return redirect()->route('superviseur-dashboard-login');
              
            default:
          
                return redirect()->route('first-page');
        }


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('first-page');
    }
}
