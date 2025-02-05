@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">
            <i class="fas fa-user-circle"></i> User Profile
        </h1>
        <p class="text-muted">Manage your personal information and account security.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <!-- Update Profile Information -->
            <div class="card shadow-sm mb-4">
               
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Change Password -->
            <div class="card shadow-sm mb-4">
                
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card shadow-sm">
                
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
