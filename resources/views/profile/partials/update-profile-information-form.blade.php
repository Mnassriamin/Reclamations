<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-user"></i> Profile Information</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <i class="fas fa-info-circle"></i> Update your account's profile information and email address.
        </p>

        <!-- Profile Update Form -->
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-user"></i> Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-warning small">
                            <i class="fas fa-exclamation-circle"></i> Your email address is unverified. 
                            <button form="send-verification" class="btn btn-link p-0 text-decoration-none">
                                <i class="fas fa-paper-plane"></i> Click here to re-send the verification email.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success small">
                                <i class="fas fa-check-circle"></i> A new verification link has been sent to your email address.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Save Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Success Message (Fades Out) -->
@if (session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-check-circle"></i> Profile updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
