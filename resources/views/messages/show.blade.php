@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5><i class="fas fa-comments"></i> Conversation - {{ $complaint->subject }}</h5>
        </div>
        <div class="card-body">
            <!-- Complaint Details -->
            <div class="mb-4 p-3 border rounded bg-light">
                <strong>Complaint Details:</strong>
                <p class="mb-1"><strong>Client:</strong> {{ $complaint->user->name ?? 'Unknown' }}</p>
                <p class="mb-1"><strong>Description:</strong> {{ $complaint->description }}</p>
                <p class="text-muted"><i class="far fa-calendar-alt"></i> Submitted on: {{ $complaint->created_at->format('M d, Y') }}</p>
            </div>

            <!-- Messages List -->
            <div class="mb-4">
                <h5 class="mb-3"><i class="fas fa-envelope"></i> Messages</h5>
                <div class="overflow-auto border rounded p-3" style="max-height: 400px;">
                    @if($messages->isEmpty())
                        <p class="text-muted text-center">No messages yet. Start the conversation.</p>
                    @else
                        @foreach($messages as $message)
                            <div class="d-flex mb-3 
                                {{ $message->user_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-2 rounded shadow-sm" 
                                    style="max-width: 70%;
                                    {{ $message->user_id == auth()->id() ? 'background: #007bff; color: white; text-align: right;' : 'background: #f1f1f1; text-align: left;' }}">
                                    <small class="fw-bold">{{ $message->user->name ?? 'Unknown' }}</small>
                                    <p class="mb-1">{{ $message->content }}</p>
                                    <small class="text-muted">{{ $message->created_at->format('H:i, M d') }}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Message Input -->
            <form method="POST" action="{{ route('messages.store', $complaint->id) }}">
                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control" placeholder="Type a message..." required>
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
