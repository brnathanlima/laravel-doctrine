@extends('master')

@section('title', 'Tasks list')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Tasks List</h3>
            <hr>
            <table class="table table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Operations</th>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $task->getId() }}</td>
                            <td>{{ $task->getName() }}</td>
                            <td>{{ $task->getDescription() }}</td>
                            <td>
                                @if ($task->isDone())
                                    Done
                                @else
                                    Not Done
                                @endif
                                - <a href="/tasks/{{ $task->getId() }}/toggle">Change</a>
                            </td>
                            <td>
                                <form action="/tasks/{{ $task->getId() }}/edit" method="GET">
                                    <button type="submit" class="btn btn-link">Edit</button>
                                </form>
                                <form action="/tasks/{{ $task->getId() }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No tasks in the list... for now!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

