<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        $users = User::paginate(10); 
      
        
        return view('admin.createuser', compact('users'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'image_de_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  
            
        ]);
    
    
        if ($request->hasFile('image_de_profil')) {
           
            $filePath = $request->file('image_de_profil')->store('avatars', 'public');
      
        }
        //dd($request->file('image_de_profil'));
      
        $user = new User();
        $user->name=$request->input('user_name');
        $user->last_name=$request->input('user_last_name');
        $user->role=$request->input('user_role');
        $user->email=$request->input('user_email');
        $user->telephone=$request->input('user_phone');
        $user->password=$request->input('user_password');
        $user->adresse=$request->input('user_address');


        $user->image_de_profil = $filePath ?? null; 
        $user->save();
    
        return redirect()->back()->with('success', 'User created successfully!');
    }






}
