<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Image; // aliased as Image in app.php, from intervention package

class PostController extends Controller
{


    /*
    * Create Post
    *
    */
    public function createPost(Request $request) {

        // Run Multi Validation Method
        if ($error = $this->validatePostData($request)) {
            return response()->json(['message'=> $error],401);
        }


        if ($request->file('image')->isValid()) {

            // Validate image
            $validated = $request->validate([
                'image' => 'mimes:jpeg,png,webp|max:3064',
            ]);

            // Image details
            $fileName = explode('.',$request->image->getClientOriginalName())[0].'-'.time();
            $filePath = public_path('storage');
            $extension = $request->image->extension();

            // Resize and save image in webp formatT
            $webpExtension = 'webp';
            $image = $request->file('image');

            $img = Image::make($image->path())->encode('webp', 90);

            $img->resize(600, 600, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$fileName.'.'.$webpExtension);

            $url = Storage::url($fileName.".".$webpExtension);
        }

        $post = new Post;
        $post->text = $request->text;
        if ($url) {
            $post->image = $url;
        }
        $post->save();
        return response()->json(
            [
                'message'=> 'Post was created!',
                'post' => $post,
            ],200
        );
	}


    /**
    * Get All Posts
    *
    * @return array
    */
    public function getPosts() {
        $posts = Post::all();
        return response()->json($posts)->setStatusCode(200);
    }

    /**
    * Get Single Post Data
    *
    * @return object
    */
    public function getPostData(Request $request) {
        $id = $request->id;
        $post = Post::where('id', $id)->first();
        return response()->json($post)->setStatusCode(200);
    }

    /*
    * Validate Post Data
    *
    */
    public function validatePostData(Request $request) {

        // Missing Info
        if (!$request->text || !$request->image) {
            return 'Some inputs from the form are not filled in';
        }
    }
}
