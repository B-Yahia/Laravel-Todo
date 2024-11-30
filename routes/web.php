<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',function(){
    return redirect()->route('tasks.index');
}
);

Route::get('/tasks', function ()  {
    return view('index',[
        'tasks'=> Task::latest()->paginate(5)
    ]);
})->name('tasks.index');

Route::view('tasks/create','create');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show',[ 'task'=>$task]);
})->name('task.show');
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit',[ 'task'=>$task]);
})->name('tasks.edit');

Route::post('/tasks',function (TaskRequest $request){
    $task = Task::create($request->validated());
    return redirect()->route('task.show',['task'=>$task->id])
    ->with('success','Task has been added');
})->name('tasks.store');

Route::put('/tasks/{task}',function (Task $task,TaskRequest $request){
    $task->update($request->validated());
    return redirect()->route('task.show',['task'=>$task->id])
    ->with('success','Task has been updated');
})->name('tasks.update');

Route::delete('/tasks/{task}',function (Task $task) {
    $task->delete();
    return redirect()->route('tasks.index');
})->name('tasks.destroy');

Route::put('/tasks/{task}/toggle-completed',function(Task $task){
    $task->completed = !$task->completed ;
    $task->save();
    return redirect()->back()->with(['success'=> 'Task status updated']);
})->name('tasks.toggle-completed');