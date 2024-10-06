@extends('auth.layouts.app')

@section('content')
    <div class="card-body">
        <p class="login-box-msg">Register Now</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Full Name" name="name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                @error('name')
                    <span class="text-danger mb-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                @error('email')
                    <span class="text-danger mb-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <p class="mb-1 mt-3">
            <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
        <p class="mb-1 mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary">Back to login page</a>
        </p>
    </div>
@endsection
