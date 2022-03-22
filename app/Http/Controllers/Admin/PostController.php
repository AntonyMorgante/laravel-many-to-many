<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Cathegory;

class PostController extends Controller
{
    protected $validation = [
        'title'=>'required|string|max:100',
        'content'=>'required',
        'cathegory_id' => 'nullable|exists:cathegories,id',
        "tags" => 'exists:tags,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        return view('admin.posts.index',compact('posts','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cathegories = Cathegory::all();
        $tags = Tag::all();
        return view('admin.posts.create',compact('cathegories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data=$request->all();
        $user_id = $request->user()->id;
        $form_data['user_id'] = $user_id;

        $request->validate($this->validation);

        $post = new Post();   

        //slug
        $slugTitle= Str::slug($form_data['title']);
        $count = 2;
        while(Post::where('slug',$slugTitle)->first()){
            $slugTitle=Str::slug($form_data['title'])."-".$count;
            $count++;
        }
        $form_data['slug'] = $slugTitle;

        //image
        if(isset($form_data['image'])) {
            $img_path = Storage::put('uploads', $form_data['image']);
            $form_data['image'] = $img_path;
        }

        $post->fill($form_data);

        $post->save();
        $post->tags()->sync(isset($form_data['tags']) ? $form_data['tags'] : [] );

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $cathegories = Cathegory::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact('post','cathegories','tags'));
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
        $user_id = $request->user()->id;
        $request['user_id'] = $user_id;
        $request->validate($this->validation);

        $form_data=$request->all();
        
        //slug 
        if(!($form_data['title'] == $post->title)){
            $count = 2;
            $slugTitle= Str::slug($form_data['title']);
            while(Post::where('slug',$slugTitle)->first()){
                $slugTitle=Str::slug($form_data['title'])."-".$count;
                $count++;
            }
            $form_data['slug'] = $slugTitle;
        }

        $post->update($form_data);
        $post->tags()->sync(isset($form_data['tags']) ? $form_data['tags'] : [] );

        return redirect()->route('admin.posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with(["message"=>"Il tuo post è stato eliminato!"]);
    }
}
