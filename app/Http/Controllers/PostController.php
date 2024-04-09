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
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

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

    // Query builder
    // public function index()
    // {
    //     $posts = Post::all();

    //     return view(
    //         'index',
    //         compact('posts')
    //     );
    // }

    // public function show(Request $request, $id)
    // {
    //     $postId = $request->input('find');
    //     $post = DB::table('posts')->where('id', $postId)->first();
    //     if ($post) {
    //         return view('show', compact('post'));
    //     } else {
    //         return redirect()->back()->with('error', 'Post not found.');
    //     }
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //     ]);

    //     Post::create($request->all());

    //     return redirect()->route('index')
    //         ->with('success', 'Post created successfully.');
    // }
    // public function crudeOperations()
    // {
    //     // MySQL Prepare Statement
    //     $host = 'localhost';
    //     $dbName = 'your_database_name';
    //     $username = 'your_username';
    //     $password = 'your_password';

    //     $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);

    //     // Create a new post
    //     $insertStatement = $pdo->prepare('INSERT INTO posts (id, title, content) VALUES (?, ?, ?)');
    //     $insertStatement->execute([51, 'New Post', 'This is the content of the new post']);

    //     // Read a post
    //     $selectStatement = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
    //     $selectStatement->execute([51]);
    //     $post = $selectStatement->fetch(PDO::FETCH_ASSOC);

    //     // Update a post
    //     $updateStatement = $pdo->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    //     $updateStatement->execute(['Updated Post', 'This is the updated content', 51]);

    //     // Delete a post
    //     $deleteStatement = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    //     $deleteStatement->execute([51]);


    //     //  PDO Prepare Statement -----------------------------------------------------
    //     $host = 'localhost';
    //     $dbName = 'your_database_name';
    //     $username = 'your_username';
    //     $password = 'your_password';

    //     $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     // Create a new post
    //     $insertStatement = $pdo->prepare('INSERT INTO posts (id, title, content) VALUES (:id, :title, :content)');
    //     $insertStatement->execute([
    //         ':id' => 51,
    //         ':title' => 'New Post',
    //         ':content' => 'This is the content of the new post'
    //     ]);

    //     // Read apost
    //     $selectStatement = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    //     $selectStatement->execute([':id' => 51]);
    //     $post = $selectStatement->fetch(PDO::FETCH_ASSOC);

    //     // Update a post
    //     $updateStatement = $pdo->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
    //     $updateStatement->execute([
    //         ':title' => 'Updated Post',
    //         ':content' => 'This is the updated content',
    //         ':id' => 51
    //     ]);

    //     // Delete a post
    //     $deleteStatement = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    //     $deleteStatement->execute([':id' => 51]);
    // }
}
