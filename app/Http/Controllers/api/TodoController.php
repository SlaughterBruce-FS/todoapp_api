<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */

    /**
     * @OA\Get(
     *     path="/api/todo",
     *     tags={"Todos"},
     *
     *     summary="Get all todos",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="index",
     *
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status values that needed to be considered for filter",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             default="available",
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *         )
     *     ),
     * security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     *
     * )
     */

    public function index()
    {
        return Todo::all();
    }


        /**
     * @OA\Get(
     *     path="/api/todo/{id}/all",
     *     tags={"Todos"},
     *     summary="Get all todos by user id",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="getall",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of user to return todos",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     *
     * )
     * @param  int  $id
     */

    public function getall(Request $request, $id)
    {
        // return $id;
        return Todo::where('user_id', $id)->get();
    }


    /**
     * Add a new pet to the store.
     *
     * @OA\Post(
     *     path="/api/todo",
     *     tags={"Todos"},
     *     operationId="store",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
  * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       @OA\Property(property="user_id", type="integer",  example="1"),
 *       @OA\Property(property="title", type="string",  example="Todo 1"),
 *       @OA\Property(property="type", type="string", example="travel"),
 *       @OA\Property(property="status", type="string", example=""),
 *       @OA\Property(property="description", type="text", example="going to the movies"),
 *       @OA\Property(property="date", type="date", example="2/16/2023"),
 *    ),
 * ),
     * )
     */

    public function store(Request $request)
    {

        $todo = Todo::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'type' => $request->type,
            'status' => $request->status,
            'description' => $request->description,
            'date' => $request-> date,
        ]);

        return $todo;
    }

       /**
     * @OA\Get(
     *     path="/api/todo/{id}",
     *     tags={"Todos"},
     *     summary="Get to do by id",
     *     description="Multiple status values can be provided with comma separated string",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of todo to return todos",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     *
     * )
     * @param  int  $id
     */


    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

        /**
     * @OA\Put(
     *     path="/api/todo/{todoId}",
     *     tags={"Todos"},
     *     summary="Updates a pet in the store with form data",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="todoId",
     *         in="path",
     *         description="ID of the todo that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *
     *     @OA\RequestBody(
     *         description="Input data format",
     *        @OA\JsonContent(
     *       @OA\Property(property="user_id", type="integer",  example="1"),
 *       @OA\Property(property="title", type="string",  example="Todo update"),
 *       @OA\Property(property="type", type="string", example="travel"),
 *       @OA\Property(property="status", type="string", example=""),
 *       @OA\Property(property="description", type="text", example="going to the movies"),
 *       @OA\Property(property="date", type="date", example="2/16/2023"),
     *
     *         ),
     *     ),
     * )
     *
     */

    public function update($id, Request $request)
    {
        $todo = Todo::where("id", $id)->first();
        $todo -> update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'type' => $request->type,
            'status' => $request->status,
            'description' => $request->description,
            'date' => $request-> date,
        ]);

        return new TodoResource($todo);
    }

    /**
     * @OA\Delete(
     *     path="/api/todo/{todoId}",
     *     tags={"Todos"},
     *     summary="Deletes a todo",
     *     operationId="destroy",
     *
     *     @OA\Parameter(
     *         name="todoId",
     *         in="path",
     *         description="Pet id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Todo not found",
     *     )
     * )
     */
    public function destroy(Todo $todo)
    {


        return $todo->delete();
    }
}
