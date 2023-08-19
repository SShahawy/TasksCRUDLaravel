<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tasks'] = Tasks::all();
        return view('index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([

            'name' => 'required',

            'desc' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        if (!$validator) {
            return redirect()->route('tasks.index')

                ->with('error', 'Data Missing !');
        }
        if ($request->start_date > $request->end_date)
            return redirect()->route('tasks.index')

                ->with('error', 'Start Date cant be after end date !');
        Tasks::create($request->all());



        return redirect()->route('tasks.index')

            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $task)
    {
        return view('show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $task)
    {
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Tasks $task)
    {
        $validator = $request->validate([

            'name' => 'required',

            'desc' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',

        ]);
        if (!$validator) {
            return redirect()->route('tasks.index')

                ->with('error', 'Data Missing !');
        }


        $task->update($request->all());



        return redirect()->route('tasks.index')

            ->with('success', 'Tasks updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();



        return redirect()->route('tasks.index')

            ->with('success', 'Task deleted successfully');
    }
}
