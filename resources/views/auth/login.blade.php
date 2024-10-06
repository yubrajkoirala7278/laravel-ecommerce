@extends('auth.layouts.app')
@section('content')
    <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ route('login') }}" method="post">
            @csrf
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
            <div class="row">
                {{-- <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" value="true" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div> --}}
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>

                <!-- /.col -->
            </div>
        </form>
        <p class="mb-1 mt-3">
            <a href="{{ route('password.request') }}">I forgot my password</a>
        </p>
        <p class="mb-1 mt-3">
            Don't have an account?<a href="{{ route('register') }}"> Register Here</a>
        </p>
    </div>
@endsection
