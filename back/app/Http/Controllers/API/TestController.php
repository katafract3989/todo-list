<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $task = Task::find($request->id);

        $task->title = $request->newTitle;
        $task->descr = $request->newDescr;

        if($task->save())

            return "Successfully modified";
        else
            return "Modification error";

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
    }


    public function create(Request $request){


        $task = Task::create($request->all());
        return $task;
    }

    public function listing(){

        header('Content-Type: application/json');

        $result = Task::all();

        $result = json_encode($result);

        return $result;


    }

    public function delete(Request $request){

        $task = Task::find($request->id);

        $task->delete();

    }

    public function status(Request $request){

        $task = Task::find($request->id);
        $task->status = 'done';
        $task->save();
        return true;

    }


}
