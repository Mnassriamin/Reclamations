@extends('layouts.guest')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 400px; width: 100%;">
        
        <!-- Header -->
        <div class="text-center">
            <i class="fas fa-user-lock fa-3x text-primary"></i>
            <h2 class="mt-3 fw-bold text-dark">Welcome Back!</h2>
            <p class="text-muted">Please log in to continue</p>
        </div>

        <!-- Session Status -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email Address</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label text-muted" for="remember_me">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>

            <!-- Forgot Password & Register -->
            <div class="text-center mt-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-primary fw-bold d-block">Forgot Password?</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary mt-2 w-100">
                        <i class="fas fa-user-plus"></i> Create an Account
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<!-- Toggle Password Visibility -->
<script>
    function togglePassword() {
        let passwordInput = document.getElementById("password");
        let icon = event.currentTarget.querySelector("i");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection
