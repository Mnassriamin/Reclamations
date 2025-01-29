@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Technician Dashboard</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Pending Complaints</h5>
        </div>
        <div class="card-body p-4">
            @if($complaints->isEmpty())
                <div class="alert alert-info text-center">No pending complaints at the moment.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $complaint)
                                <tr>
                                    <td class="fw-bold">{{ $complaint->id }}</td>
                                    <td>{{ $complaint->subject }}</td>
                                    <td>
                                        <!-- Preview Button -->
                                        <button class="btn btn-info btn-sm" onclick="showComplaint({{ $complaint->id }})">
                                            <i class="fas fa-eye"></i> Preview
                                        </button>
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

<!-- Modal for Complaint Preview -->
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="complaintModalLabel">Complaint Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Subject:</strong> <span id="modalSubject"></span></h6>
                <p><strong>Description:</strong></p>
                <p id="modalDescription"></p>
                <p><strong>Customer:</strong> <span id="modalCustomer"></span></p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="" id="complaintActionForm" class="d-flex gap-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="treated" class="btn btn-success">
                        <i class="fas fa-check"></i> Treated
                    </button>
                    <button type="submit" name="status" value="cancelled" class="btn btn-danger">
                        <i class="fas fa-times"></i> Cancelled
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Showing Modal with Complaint Details -->
<script>
    function showComplaint(complaintId) {
    // Fetch the complaint data safely
    const complaint = @json($complaints).find(c => c.id === complaintId);

    if (!complaint) {
        console.error("Complaint not found!");
        return;
    }

    // Safely set user name
    const customerName = complaint.user ? complaint.user.name : "Unknown Customer";

    // Populate modal fields
    document.getElementById('modalSubject').textContent = complaint.subject;
    document.getElementById('modalDescription').textContent = complaint.description;
    document.getElementById('modalCustomer').textContent = customerName;

    // Update form action URL
    document.getElementById('complaintActionForm').action = `/technician/updateStatus/${complaintId}`;

    // Show the modal
    const complaintModal = new bootstrap.Modal(document.getElementById('complaintModal'));
    complaintModal.show();
}

</script>
@endsection
