<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use PDO;

/**
 * @OA\Info(
 *      title="API Documentation",
 *      version="1.0.0",
 *      description="API documentation for your application",
 * )

 * @OA\Get(
 *     path="/api/posts",
 *     summary="Get all posts",
 *     @OA\Response(response="200", description="Success"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Put(
 *     path="/api/posts/{id}",
 *     summary="Update a post",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the post",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="Post not found"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Get(
 *     path="/api/posts/{id}",
 *     summary="Get a post by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the post",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="Post not found"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Post(
 *     path="/api/posts",
 *     summary="Create a new post",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(response="201", description="Post created"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Delete(
 *     path="/api/posts/{id}",
 *     summary="Delete a post by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the post",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response="200", description="Post deleted"),
 *     @OA\Response(response="404", description="Post not found"),
 *     security={{"bearerAuth": {}}}
 * )
 */
class PostController extends Controller
{
    public function index(Request $request){
        $posts = DB::table('posts')->get();
        return view('index',compact('posts'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|min:5|max:100',
            'description' => 'required|min:10|max:50',
        ]);
        $post = new Post($validatedData);
        $post->save();
    }

    public function show(Request $request){
        $post = Post::find($request->id);
        return view('show',compact('post'));
    }

    public function update(Request $request){
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
    }

    public function destroy(Request $request){
        $post = Post::find($request->id);
        $post->delete();
    }
}
