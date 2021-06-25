<?php

namespace App\Http\Controllers;

use App\Repository\TaskRepository;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    private  $repositry;

    public function __construct(TaskRepository $repositry)
    {
        $this->repositry = $repositry;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' =>$this->repositry->findAll()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60|unique:tasks',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>  $validator->errors()], 403);
        }

        $task = new Task(['name' => $request->input('name')]);
        $newTask = $this->repositry->save($task);

        if($newTask != null) {
            return response()->json(['data' => $newTask], 201);
        } else {
            return response()->json(['message' => 'Task not created'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->repositry->findByID($id);
        if($task != null) {
            return response()->json(['data' =>$task], 200);
        } else {
            return response()->json(['message' =>'Not found task'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60',
            'completed' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' =>  $validator->errors()], 403);
        }

        $task = new Task($request->all());
        $updateTask = $this->repositry->updateById($id, $task);

        if($updateTask != null) {
            return response()->json(['data' => $updateTask], 201);
        } else {
            return response()->json(['message' => 'Not found task'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = $this->repositry->deleteById($id);

        if($task != null && $task > 0) {
            return response()->json(['message' => 'Task deleted'], 201);
        } else {
            return response()->json(['message' => 'Not found task'], 500);
        }
    }

    public function findByName($name)
    {
        return response()->json(['data' =>$this->repositry->findByName($name)], 200);
    }
}
