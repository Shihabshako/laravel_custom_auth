@extends('index')
@section('title', 'Home')

@section('content')
  <div class="card w-25">
    <div class="card-header text-success">
      <strong>Login Successful</strong>
    </div>
    <div class="card-body">
        <h6>Welcome {{ session("name") }}</h6>
    </div>
    <div class="card-footer d-flex justify-content-end">
      <a href="{{ route("logout") }}" type="submit" class="btn btn-danger">Logout</a>
    </div>
  </div>
@endsection