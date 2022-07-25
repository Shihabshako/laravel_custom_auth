@extends('index')
@section('title', 'Login')

@section('content')
  <div class="card w-25">
    <div class="card-header d-flex justify-content-between">
      <strong>Login</strong>
      <span class="text-danger">{{ session("error") }}</span>  
    </div>
    <form action="{{ route("verifyUser") }}" method="POST">
      @csrf
      <div class="card-body">
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" required name="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" required  name="password">
            <small class="text-danger d-none" id="passwordValidation"></small>
          </div>
          <div class="mb-3 d-flex">
            <span>New here? <a href="{{ route("signup") }}">Register</a></span>
          </div>
      </div>
      <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>
@endsection