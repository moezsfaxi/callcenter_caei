<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{

    public function create(){
     
     $posts = Post::orderBy('created_at', 'desc')->paginate(6);
     
     return View('admin.feed',compact('posts'));


    }
    public function createpost(){
     
        
        
        return View('admin.createpost');
   
   
       }

       public function store (Request $request)
       {
           //dd($request);
           $validatedData = $request->validate([
               'post_text' => 'required|string',
               //'post_image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
               'post_image' => 'nullable',
               'agent' => 'required|in:yes,no',
               'superviseur' => 'required|in:yes,no',
               'partenaire' => 'required|in:yes,no',
           ]);
       
          
           $imagePath = null;
           if ($request->hasFile('post_image')) {
 
               $imagePath = $request->file('post_image')->store('posts', 'public');
           }
       
          
           Post::create([
               'post_text' => $validatedData['post_text'],
               'post_image' => $imagePath,
               'agent' => $validatedData['agent'],
               'superviseur' => $validatedData['superviseur'],
               'partenaire' => $validatedData['partenaire'],
           ]);
       
          
           return redirect()->route('feed-admin')->with('success', 'Post created successfully!');
       }
    

       public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('feed-admin')->with('success', 'Post deleted successfully!');
    }

    public function gotoeditview($id) {
        $post = Post::findOrFail($id);
        return view('admin.edit', compact('post')); 
    }

    
    public function update(Request $request, $id) {
        $post = Post::findOrFail($id);
        $post->update($request->only('post_text', 'post_image'));
        return redirect()->route('feed-admin')->with('success', 'Post updated successfully!');
    }    


    public function agentpost(){
     
        $posts = Post::where('agent','yes')->orderBy('created_at', 'desc')->paginate(6);
        
        return View('agent.feed',compact('posts'));
   
   
       }
    
       public function partenairepost(){
     
        $posts = Post::where('partenaire','yes')->orderBy('created_at', 'desc')->paginate(6);
        
        return View('partenaire.feed',compact('posts'));
   
   
       } 
       
       public function superviseurpost(){
     
        $posts = Post::where('superviseur','yes')->orderBy('created_at', 'desc')->paginate(6);
        
        return View('superviseur.feed',compact('posts'));
   
   
       } 




}
