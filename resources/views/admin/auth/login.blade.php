@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')
<div class="min-vh-100 bg-light d-flex align-items-center">
<div class="row justify-content-center w-100">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Admin Login</h3>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

