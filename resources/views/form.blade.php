@section('title', @isset($task) ? 'Edit Task' : 'Add new Task')

@section('content')
    <form action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}" method="POST">

        @csrf

        @isset($task)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="title" class="label">Title</label>
            <input @class(['border-red-500' => $errors->has('title')]) type="text" name='title' id="title"
                value=" {{ $task->title ?? old('title') }} " />
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="label">Description</label>
            <textarea @class(['border-red-500' => $errors->has('description')]) type="text" name='description' id="description" rows="5">
                {{ $task->description ?? old('description') }}
            </textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="long_description" class="label">Long Description</label>
            <textarea @class(['border-red-500' => $errors->has('long_description')]) type="text" name='long_description' id="long_description" rows="10">
                {{ $task->long_description ?? old('long_description') }}
            </textarea>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <button type="submit" class="btn">
                @isset($task)
                    Edit Task
                @else
                    Add Task
                @endisset
            </button>
        </div>
    </form>
@endsection
