@extends('auth.layouts.app')
@section('content')
    <div class="card-body">

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
            <p class="text-center small">Enter email to reset your password</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="row g-3 needs-validation" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="email@gmail.com"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Send Password Reset Link</button>
            </div>
        </form>

    </div>
@endsection
