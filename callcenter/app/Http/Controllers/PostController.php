<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
               'post_video' => 'nullable',
               'post_image' => 'nullable',
               'agent' => 'required|in:yes,no',
               'superviseur' => 'required|in:yes,no',
               'partenaire' => 'required|in:yes,no',
           ]);
       
          
           $imagePath = null;
           if ($request->hasFile('post_image')) {
 
               $imagePath = $request->file('post_image')->store('posts', 'public');
           }

           $videoPath = null;
           if ($request->hasFile('post_video')) {
               $videoPath = $request->file('post_video')->store('posts/videos', 'public'); 
           }
       
          
           Post::create([
               'post_text' => $validatedData['post_text'],
               'post_image' => $imagePath,
               'post_video' => $videoPath,
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

       public function like(Request $request, $postId)
{
    //dd($postId);
    $post = Post::findOrFail($postId);
    $userId = Auth::id();

    $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();

    if ($like) {
        $like->delete();
        return response()->json(['status' => 'unliked']);
    } else {
        Like::create(['post_id' => $postId, 'user_id' => $userId]);
        return response()->json(['status' => 'liked']);
    }
}
public function commentstore(Request $request, $postId)
{
    $post = Post::findOrFail($postId);
    $user = Auth::user();

    $comment = new Comment;
    $comment->post_id = $post->id;
    $comment->user_id = $user->id;
    $comment->content = $request->content; 
    $comment->save();

    return response()->json([
        'image_de_profil' => $user->image_de_profil,
        'name'    => $user->name ,
        'comment' => $comment,
        'status' => 'success'
    ]);
}













}
