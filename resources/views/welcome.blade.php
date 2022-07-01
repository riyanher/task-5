@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white shadow-sm">
    <div class="py-4 my-4 text-center">
        <h1 class="display-5 fw-bold">Welcome</h1>
        <div class="col-lg-8 mx-auto">
          <p class="lead mb-4">This is a simple website where you can read posts, create them, modify them and even delete them. But, before you can do all that stuff, you need to create an account first. Then, login and enjoy all the feature available. </p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a class="btn btn-outline-primary btn-lg px-4 gap-3" href="{{ route('login') }}">Login</a>
            <a class="btn btn-outline-success btn-lg px-4" href="{{ route('register') }}">Register</a>
          </div>
        </div>
    </div>   
</div>
@endsection
