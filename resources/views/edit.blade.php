@extends('master')

@section('title', 'Edit Task')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Edit Task</h3>
            <p>Use the following form to edit che chosen task.</p>
            <hr>

            <form action="/tasks/{{ $task->getId() }}" method="POST">
                @method('PATCH')
                @csrf
                <p>
                    <input type="text" name="name" id="name" autofocus placeholder="Name" class="form-control" value="{{ $task->getName() }}">
                </p>
                <p>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $task->getDescription() }}</textarea>
                </p>
                <hr>
                <p>
                    <button class="form-control btn btn-success">Edit Task</button>
                </p>
            </form>
        </div>
    </div>
@endsection
