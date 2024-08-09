<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:230',
            'completed'  => 'required|boolean'
        ]);

        $task = Task::create($validatedData);

        return response()->json(['message' => 'Task created successfully','data' => $task], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);  
        }

        return $task;
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
        $task = Task::findOrFail($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);  
        }

        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:230',
            'completed'  => 'required|boolean'
        ]);

        $task->update($validatedData);

        $task = Task::findOrFail($id);

        return response()->json(['message' => 'Task updated successfully', 'data' => $task], 202);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCompleted(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);  
        }

        $validatedData = $request->validate([
            'completed'  => 'required|boolean',
        ]);

        $task->update($validatedData);

        $task = Task::findOrFail($id);

        return response()->json(['message' => 'Task updated successfully', 'data' => $task], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);  
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
