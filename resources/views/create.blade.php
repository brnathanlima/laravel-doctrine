@extends('master')

@section('title', 'Add a task')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Add task</h3>
            <p>Use the following form to add a new task to the system.</p>
            <hr>

            <form action="/tasks" method="POST">
                @csrf
                <p>
                    <input type="text" name="name" id="name" autofocus placeholder="Name" class="form-control">
                </p>
                <p>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                </p>
                <hr>
                <p>
                    <button class="form-control btn btn-success">Add Task</button>
                </p>
            </form>
        </div>
    </div>
@endsection
