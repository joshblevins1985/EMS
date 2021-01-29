<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Vanguard\ToDo;
use Vanguard\ToDoNote;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $todo = new ToDo;
        
        $todo->task = $request->task;
        $todo->expected_complete = ($request->expected_complete_submit ? $request->expected_complete_submit : Null);
        $todo->assigned_to = ($request->assigned_to ? $request->assigned_to : Auth()->user()->id );
        $todo->department = $request->department;
        $todo->status = 1;
        
        $todo->save();

        $return_arr[] = array(
            "id" => $todo->id,
            "message" => 'You have added a new todo item. '. $todo->task,
            );

        if($request->ajax()){
            return json_encode($return_arr);
        }

        return back()->with('success', 'You have added a new task assignment.');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function note(Request $request)
    {
        $todo = new ToDoNote;
        
        $todo->note = $request->note;
        $todo->added_by = auth()->User()->id;
        $todo->task_id = $request->tid;
        
        $todo->save();
        
        return back()->with('success', 'You have added a new task assignment.');
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
    public function complete(Request $request, $id)
    {
        $todo = ToDo::find($id);
        
        $todo->completed = date('Y-m-d');
        $todo->completed_by = auth()->User()->id;
        $todo->status = 4;
        $todo->save();

        $return_arr[] = array(
            "id" => $todo->id,
            "message" => 'You have marked a task completed. '. $todo->task,
        );

        if($request->ajax()){
            return json_encode($return_arr);
        }
        
        return back()->with('success', 'You have completed a task.');
    }

    public function uncomplete(Request $request, $id)
    {
        $todo = ToDo::find($id);

        $todo->completed = null;
        $todo->completed_by = null;
        $todo->status = 1;
        $todo->save();

        $return_arr[] = array(
            "id" => $todo->id,
            "message" => 'You have added the task back to the todo list. '. $todo->task,
        );

        if($request->ajax()){
            return json_encode($return_arr);
        }

        return back()->with('success', 'You have completed a task.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request, $id)
    {
        $todo = ToDo::find($id);
        
        $todo->status = 2;
        $todo->save();

        $return_arr[] = array(
            "id" => $todo->id,
            "message" => 'You have changed the status to working. '. $todo->task,
        );

        if($request->ajax()){
            return json_encode($return_arr);
        }

        return back()->with('success', 'You have made the task active.');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = ToDo::destroy($id);

        $return_arr[] = array(
            "message" => 'You have deleted a task ',
        );


            return json_encode($return_arr);


    }
}
