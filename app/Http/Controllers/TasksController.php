<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(Tasks::all());
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
        $task = new Tasks;
        $task->name = $request->name;
        $saved = $task->save();

        if ($saved) {
            $task = Tasks::all();
            return response()->json($task);
        } else {
            return response($saved, 400);
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
        //
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
        //
        $task = Tasks::findOrFail($id);
        $task->done = !$task->done;
        $saved = $task->save();

        if ($saved) {
            $task = Tasks::all();
            return response()->json($task);
        } else {
            return response($saved, 400);
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
        //
        $task = Tasks::findOrFail($id);
        $deleted = $task->delete();

        if ($deleted) {
            $task = Tasks::all();
            return response()->json($task);
        } else {
            return response($deleted, 400);
        }
    }
}
