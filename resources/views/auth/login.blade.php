@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header bg-dark opacity-75"><p class="fs-4 text-center text-white mb-0">Login</p></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                          <label for="email" class="form-label">Email Address</label>
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <div class="row">
                                <div class="col-auto me-auto">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('password.request') }}" class="link-secondary">Forget your password?</a>
                                </div>
                            </div>
                        </div>
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary mb-2">Login</button>
                                <p>Don't have an account? Register <span><a href="{{ route('register') }}">here</a></span>
                            </div>
                        </div>        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
