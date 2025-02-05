@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 450px; width: 100%;">
        
        <!-- Header -->
        <div class="text-center">
            <i class="fas fa-user-plus fa-3x text-primary"></i>
            <h2 class="mt-3 fw-bold text-dark">Create an Account</h2>
            <p class="text-muted">Sign up to submit and track complaints</p>
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Full Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                <div class="input-group">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-user-check"></i> Register
            </button>

            <!-- Already Have an Account -->
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-primary fw-bold">Already have an account? Log in</a>
            </div>
        </form>
    </div>
</div>

<!-- Toggle Password Visibility -->
<script>
    function togglePassword(fieldId) {
        let input = document.getElementById(fieldId);
        let icon = event.currentTarget.querySelector("i");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection
