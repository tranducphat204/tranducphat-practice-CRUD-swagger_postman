<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**

 * @OA\Get(
 *     path="/api/users",
 *     summary="Get all users",
 *     @OA\Response(response="200", description="Success"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Update a user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user",
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
 *     @OA\Response(response="404", description="user not found"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Get a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response="200", description="Success"),
 *     @OA\Response(response="404", description="user not found"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Post(
 *     path="/api/users",
 *     summary="Create a new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(response="201", description="user created"),
 *     security={{"bearerAuth": {}}}
 * )
 *
 * @OA\Delete(
 *     path="/api/users/{id}",
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the user",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(response="200", description="user deleted"),
 *     @OA\Response(response="404", description="user not found"),
 *     security={{"bearerAuth": {}}}
 * )
 */

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->get();
        return $user;
    }

    public function update(Request $request)
    {
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password')

            ]);
        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }
        return response()->json($user);
    }

    public function show(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = new user($validatedData);
        $user->save();
        return response()->json($user, 201);
    }

    public function destroy(Request $request)
    {
        $id = $request->query('id');
        DB::table('users')->where('id', $request->id)->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}
