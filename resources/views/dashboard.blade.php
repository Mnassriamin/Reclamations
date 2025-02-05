@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <div class="text-center mb-4">
        <h1 class="fw-bold text-primary">
            <i class="fas fa-clipboard-list"></i> Your Complaints
        </h1>
        <p class="text-muted">Track the status of your submitted complaints in real time.</p>
    </div>

    @if($complaints->isEmpty())
        <!-- Empty State -->
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm p-4 text-center">
                <p class="fs-5 text-muted">🧐 No complaints submitted yet.</p>
                <a href="{{ route('complaints.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus-circle"></i> Submit a Complaint
                </a>
            </div>
        </div>
    @else
        <!-- Complaints Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($complaints as $complaint)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-header text-white 
                            @if($complaint->status == 'pending') bg-warning
                            @elseif($complaint->status == 'treated') bg-success
                            @else bg-danger
                            @endif">
                            <strong>
                                @if($complaint->status == 'pending') ⏳ Pending
                                @elseif($complaint->status == 'treated') ✅ Treated
                                @else ❌ Cancelled
                                @endif
                            </strong>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ ucfirst($complaint->subject) }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($complaint->description, 100, '...') }}
                            </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                            <span class="text-muted">
                                <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($complaint->created_at)->format('M d, Y') }}
                            </span>
                            <button class="btn btn-sm btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#complaintModal"
                                    onclick="showComplaint('{{ $complaint->subject }}', '{{ addslashes($complaint->description) }}', '{{ $complaint->created_at }}')">
                                View Details →
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Complaint Details Modal -->
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalDescription"></p>
                <p class="text-muted">
                    <i class="far fa-calendar-alt"></i> <span id="modalDate"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    function showComplaint(subject, description, date) {
        document.getElementById("modalTitle").innerText = subject;
        document.getElementById("modalDescription").innerText = description;
        document.getElementById("modalDate").innerText = new Date(date).toDateString();
    }
</script>
@endsection
