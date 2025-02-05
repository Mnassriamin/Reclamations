<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Delete Account</h5>
    </div>
    <div class="card-body">
        <p class="text-muted">
            <i class="fas fa-info-circle"></i> Once your account is deleted, all of its resources and data will be permanently erased. 
            Before proceeding, please download any data or information that you wish to keep.
        </p>

        <!-- Delete Account Button -->
        <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmDeletionModal">
            <i class="fas fa-trash-alt"></i> Delete Account
        </button>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div class="modal fade" id="confirmDeletionModal" tabindex="-1" aria-labelledby="confirmDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeletionModalLabel">
                    <i class="fas fa-exclamation-circle"></i> Confirm Account Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">
                    Are you sure you want to delete your account? 
                    Once deleted, all your data will be permanently lost. 
                    Please enter your password to confirm.
                </p>

                <!-- Delete Account Form -->
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Confirm Deletion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
