@extends('master')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Login</h3>
            <p>Use the following form to login into the system.</p>
            <hr>
            <form action="/login" method="POST">
                @csrf
                <p>
                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                </p>
                <p>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </p>
                <hr>
                <p>
                    <button type="submit" class="btn btn-success">Login</button>
                </p>
            </form>
        </div>
    </div>
@endsection
