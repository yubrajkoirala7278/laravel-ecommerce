@extends('auth.layouts.app')
@section('content')
<div class="card-body">

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="col-12">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="email"  value="{{ $email ?? old('email') }}"
                >
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" 
            autocomplete="new-password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="password-confirm" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password-confirm" 
            autocomplete="new-password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit"> {{ __('Reset Password') }}</button>
        </div>
    </form>

</div>
@endsection