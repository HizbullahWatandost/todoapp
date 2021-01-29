<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Todo;
use Illuminate\Http\Request;
use App\Step;

class TodoResourceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = auth()->user()->todos->sortBy('completed');
        //return view('todos.index')->with(['todos'=> $todos]);
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoCreateRequest $request)
    {
        $request['user_id'] = auth()->id();
        $todo = auth()->user()->todos()->create($request->all());
        if($request->step){
            foreach($request->step as $step){
                $todo->steps()->create(['name'=>$step]);
            }
        }
        
        return redirect(route('todo.index'))->with('message', 'Todo created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoCreateRequest $request, Todo $todo)
    {
        if($request->stepName){
            foreach($request->stepName as $key => $value){
                $id = $request->stepId[$key];
                if(!$id){
                    $todo->steps()->create(['name' => $value]);
                }
                else{
                    $step = Step::find($id);
                    $step->update(['name'=>$value]);
                }
            }
        }
        $todo->update(['title' => $request->title]);
        $todo->update(['description' => $request->description]);
        return redirect(route('todo.index'))->with('message', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->steps->each->delete();
        $todo->delete();
        return redirect()->back()->with('message', 'Task deleted!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed' => true]);
        return redirect()->back()->with('message', 'Task Marked as Completed!');
    }

    public function incomplete(Todo $todo)
    {
        $todo->update(['completed' => false]);
        return redirect()->back()->with('message', 'Task Marked as Incompleted!');
    }

}
