@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Submit a Complaint</h3>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('complaints.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Dropdown for Common Issues -->
                        <div class="mb-3">
                            <label for="issue_type" class="form-label fw-bold">Select a Common Issue</label>
                            <select class="form-select" id="issue_type" required onchange="updateSubject()">
                                <option value="">-- Select an issue --</option>
                                <option value="Slow Internet">Slow Internet</option>
                                <option value="No Connection">No Connection</option>
                                <option value="Billing Issue">Billing Issue</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">Please select an issue.</div>
                        </div>

                        <!-- Subject Field (Auto-filled from dropdown) -->
                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number Field -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone Number</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Enlarged Description Text Area -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Detailed Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="8" required style="resize: none; min-height: 180px;">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Complaint
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <small class="text-muted">Your complaint will be processed as soon as possible.</small>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Auto-Fill Subject Based on Common Issue -->
<script>
    function updateSubject() {
        let issueType = document.getElementById("issue_type").value;
        let subjectField = document.getElementById("subject");

        if (issueType === "Other") {
            subjectField.value = "";
            subjectField.readOnly = false;  // Allow user input
        } else {
            subjectField.value = issueType;
            subjectField.readOnly = true;   // Prevent user from modifying
        }
    }
</script>
@endsection
