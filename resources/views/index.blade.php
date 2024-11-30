@extends('layouts.app')

@section('title', 'List of tasks!')
@section('content')
    <nav class="mb-4">
        <a class="link" href="/tasks/create">
            Add new task
        </a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('task.show', ['task' => $task->id]) }}" @class(['font-bold', 'line-through' => $task->completed])>
                {{ $task->title }}
            </a>
        </div>
    @empty
        <div>There are no tasks</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">{{ $tasks->links() }}</nav>
    @endif
@endsection
