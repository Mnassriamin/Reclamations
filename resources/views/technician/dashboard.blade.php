@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary"><i class="fas fa-tools"></i> Technician Dashboard</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-exclamation-circle"></i> Pending Complaints</h5>
            <span class="badge bg-light text-dark">{{ $complaints->count() }} Active</span>
        </div>

        <div class="card-body p-4">
            @if($complaints->isEmpty())
                <div class="alert alert-info text-center">✅ No pending complaints at the moment.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Client</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $complaint)
                                <tr>
                                    <td class="fw-bold">{{ $complaint->id }}</td>
                                    <td>{{ ucfirst($complaint->subject) }}</td>
                                    <td>
                                        <i class="fas fa-user-circle text-primary"></i> 
                                        {{ $complaint->user->name ?? 'Unknown User' }}
                                    </td>
                                    <td>
                                        <!-- Preview Button -->
                                        <button class="btn btn-info btn-sm" onclick="showComplaint({{ $complaint->id }})">
                                            <i class="fas fa-eye"></i> Preview
                                        </button>
                                    
                                        <!-- View Messages Button with Notification Badge -->
                                        @php
                                            $unreadMessages = \App\Models\Message::unread(auth()->id())->where('complaint_id', $complaint->id)->count();
                                        @endphp
                                    
                                        <a href="{{ route('messages.show', $complaint->id) }}" class="btn btn-outline-primary btn-sm position-relative">
                                            <i class="fas fa-comments"></i> Messages
                                            @if($unreadMessages > 0)
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    {{ $unreadMessages }}
                                                </span>
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Complaint Details Modal -->
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="complaintModalLabel"><i class="fas fa-clipboard-list"></i> Complaint Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Subject:</strong> <span id="modalSubject"></span></h6>
                <p><strong>Description:</strong></p>
                <p id="modalDescription"></p>
                <p><strong>Client:</strong> <span id="modalCustomer"></span></p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <form method="POST" action="" id="complaintActionForm">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="treated" class="btn btn-success">
                        <i class="fas fa-check"></i> Mark as Treated
                    </button>
                    <button type="submit" name="status" value="cancelled" class="btn btn-danger">
                        <i class="fas fa-times"></i> Cancel Complaint
                    </button>
                </form>
                <a href="{{ route('messages.show', 0) }}" class="btn btn-outline-primary" id="messageLink">
                    <i class="fas fa-comments"></i> View Messages
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Showing Complaint Details -->
<script>
    function showComplaint(complaintId) {
        const complaint = @json($complaints).find(c => c.id === complaintId);

        if (!complaint) {
            console.error("Complaint not found!");
            return;
        }

        const customerName = complaint.user ? complaint.user.name : "Unknown Client";

        // Populate modal fields
        document.getElementById('modalSubject').textContent = complaint.subject;
        document.getElementById('modalDescription').textContent = complaint.description;
        document.getElementById('modalCustomer').textContent = customerName;

        // Update form action URL
        document.getElementById('complaintActionForm').action = `/technician/updateStatus/${complaintId}`;

        // Update View Messages Link
        document.getElementById('messageLink').href = `/complaints/${complaintId}/messages`;

        // Show the modal
        new bootstrap.Modal(document.getElementById('complaintModal')).show();
    }
</script>
@endsection
