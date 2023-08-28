<?php

namespace App\Http\Controllers\Admin;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.posts.index', ['posts' =>Post::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes['slug']= Str::slug($request['title']);
        $request['slug']=$attributes['slug'];
        //validate attributes
        $attributes=$this->validatePost();

        //moving and storing thumbnail image 
        $attributes['thumbnail']=request()->file('thumbnail')->store('thumbnails', ['disk' => 'public']);

        $attributes['user_id']=auth()->id();

        
        Post::create($attributes);
        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=Category::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' =>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $attributes['slug']= Str::slug($request['title']);
        $request['slug']=$attributes['slug'];
      
        $attributes=$this->validatePost($post);
               
        if($attributes['thumbnail'] ?? false)
             $attributes['thumbnail']=request()->file('thumbnail')->store('thumbnails', ['disk' => 'public']);

        // $attributes['user_id']=auth()->id();

        
        $post->update($attributes);
        return redirect('/')->with('success', 'successfully post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        

        // if(Storage::exists('storage/thumbnails/$post->thumbnail')){
            Storage::delete('storage/thumbnails/$post->thumbnail');
          
        // }

        $post->delete();
        return back()->with('success', 'Post deleted successfully');
       
    }


    protected function validatePost(?Post $post=null){

        $post ??= new Post();
        return request()->validate([

            
           
    
                'title' => 'required|min:5|max:125',
                'excerpt' => 'required',
                'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
                'body' =>'required',
                'category_id' =>[ 'required', Rule::exists('categories', 'id')],
                'slug' =>['required', Rule::unique('posts', 'slug')->ignore($post->id)]
    
          
        ]);
    }
}
