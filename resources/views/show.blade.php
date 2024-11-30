@extends('layouts.app') @section('title', $task->title) @section('content')
<div class="mb-4">
    <a class="link" href="{{ route('tasks.index') }}">Go to task list</a>
</div>

<p class="mb-4 text-slate-700">{{ $task->description }}</p>
@if ($task->long_description)
    <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
@endif

<p class="mb-4 text-sm text-slate-500">
    {{ $task->created_at->diffForHumans() }} -
    {{ $task->updated_at->diffForHumans() }}
</p>
<p class="font-medium mb-4 text-red-500">
    {{ $task->completed ? 'Task complited' : 'Task not completed' }}
</p>

<div class="flex gap-2">
    <a href=" {{ route('tasks.edit', ['task' => $task]) }} " class="btn">Edit</a>
    <form method="POST" action=" {{ route('tasks.toggle-completed', ['task' => $task->id]) }} ">
        @csrf @method('PUT')
        <button class="btn">
            {{ $task->completed ? 'Mark task uncomplited' : 'Mark task completed' }}
        </button>
    </form>

    <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
        @csrf @method('DELETE')
        <button class="btn">Delete</button>
    </form>
</div>
@endsection
