<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-lock"></i> Update Password</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <i class="fas fa-info-circle"></i> Ensure your account is using a strong password to stay secure.
        </p>

        <!-- Password Update Form -->
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter your current password" required>
                @error('current_password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter a new password" required>
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your new password" required>
                @error('password_confirmation')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Success Message (Fades Out) -->
@if (session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-check-circle"></i> Password updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
