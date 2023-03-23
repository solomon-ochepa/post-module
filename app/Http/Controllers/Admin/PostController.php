<?php

namespace Modules\Post\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Post\app\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\App\Http\Requests\StorePostRequest;
use Plank\Mediable\Facades\MediaUploader;

class PostController extends Controller
{
    public $data = [];

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $this->data['title'] = 'All Posts';
        $this->data['posts'] = Post::paginate(15);

        return response(view('post::admin.index', $this->data));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $this->data['title'] = 'Create New Post';
        $this->data['user'] = auth()->user();

        return response(view('post::admin.create', $this->data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $exists = Post::where('title', $request->post['title'])->count();
        if ($exists) {
            session()->flash('status', 'Post already exist.');
            return back()->withInput();
        }

        $data = $request->post;

        if ($request->filled('post.allow_comments')) {
            $data['allow_comments'] = ($data['allow_comments'] == 'on') ? 1 : 0;
        }

        $post = Post::create($data);

        // Categorizables

        // Medias
        if ($request->hasFile('images')) {
            $media = MediaUploader::fromSource($request->file('images'))
                ->useHashForFilename()
                ->onDuplicateUpdate()
                ->upload();

            if ($media) {
                $post->syncMedia($media, 'image');
            }
        }

        session()->flash('status', 'Post created successfully');
        return redirect(route('admin.post.index'));
    }

    /**
     * Display the specified resource.
     */
    // public function show(Post $post): Response
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Response
    {
        $this->data['title'] = 'All Posts';
        $this->data['posts'] = Post::paginate(15);

        return response(view('post::admin.edit', $this->data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        session()->flash('status', 'Record deleted successfully.');
        return redirect(route('admin.post.index'));
    }
}
