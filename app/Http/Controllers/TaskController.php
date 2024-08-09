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

        // Si valido los datos crea
        $task = Task::create($validatedData);

        // Retorno de la tarea creada
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
        $task = Task::find($id);

        if (!$task) {
            // Si no consigue la tarea a mostrar
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Retorno de la tarea
        return $task;
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
        $task = Task::find($id);

        if (!$task) {
            // Si no consigue la tarea a editar
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:230',
            'completed'  => 'required|boolean'
        ]);

        // Si valido los datos actualiza
        $task->update($validatedData);

        $task = Task::find($id);

        // Retorno de la tarea actualizada

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
        $task = Task::find($id);

        if (!$task) {
            // Si no consigue la tarea a editar
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validatedData = $request->validate([
            'completed'  => 'required|boolean',
        ]);

        // Si valido los datos actualiza
        $task->update($validatedData);

        $task = Task::find($id);

        // Retorno de la tarea actualizada
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
        $task = Task::find($id);

        if (!$task) {
            // Si no consigue la tarea a borrar
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Borrando la tarea y el mensaje de exito
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
