<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Posts\CreateRequest;
use App\Http\Requests\Auth\Posts\UpdateRequest;
use App\Models\categories;
use App\Models\Gallery;
use App\Models\posts;
use App\Models\tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = posts::paginate(10);
        return view('auth.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       $categories = categories::all(); 
       $tags = tags::all(); 
       return view('auth.posts.create')->with('categories', $categories)->with('tags', $tags); 
    }

    //  $fileName = rand(100, 1000).time().$file->getClientOriginalName();
    //        $filePath = public_path('/storage/auth/posts/');            
    //         $file->move($filePath, $fileName);
    //         // dd('Moved');

    //         $gallery = Gallery::create([
    //             'image' => $fileName,
    //             'type' => Gallery::POST_IMAGE,
    //         ]);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try{
        
            DB::transaction(function() use($request){

        if($file = $request->file('file')){
           $gallery = $this->uploadFile($file);      
        }     
        $posts = posts::create([
        'gallery_id' => $gallery->id, 
        'user_id' => auth()->id(), 
        'title' => $request->title, 
        'description' => $request->description, 
        'status' => $request->status, 
        'category_id' => $request->category, 
      ]);

      foreach($request->tags as $tag){
          $posts->tags()->attach($tag);  
      }
      });
      $request->session()->flash('alert-success', 'Post Created Successfully');
      
      return to_route('posts.index');

    }catch(\Exception $ex){
    
        return back()->withErrors($ex->getMessage());
    }
      return "Successfully Done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(posts $post)
    {
        return view('auth.posts.show', compact('post'));
    }
    
    /**
     * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $post = posts::find($id);
        $categories = categories::all(); 
        $tags = tags::all(); 
        return view('auth.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, posts $post)
    {
        if($request->file('file')){
            dd('Yes');
        }
        else{
            dd('NO');
        }

        $post->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category,
        ]);
        foreach($request->tags as $tag){
          $post->tags()->attach($tag);  
        }

         $request->session()->flash('alert-success', 'Post Updated Successfully');
         
         return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(posts $post)
    {
        $post->tags()->detach();
        $post->delete();
        request()->session()->flash('alert-success', 'Post Deleted Successfully');
        return to_route('posts.index');
    }

    private function uploadFile($file){
        $fileName = rand(100, 1000).time().$file->getClientOriginalName();
        $filePath = public_path('/storage/auth/posts/');            
        $gallery = $file->move($filePath, $fileName);
        
         $this->storeImage($fileName);   
        return $gallery;
        }

        private function storeImage($fileName){
            $gallery = Gallery::create([
                'image' => $fileName,
                'type' => Gallery::POST_IMAGE,
            ]);
            return $gallery;
        }
        
}
