@extends('layouts.admin')

@section('title', 'View Message - Dashboard')

@section('content')
<div  >
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Message Details</h4>
                    <div>
                        <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Message Content -->
                            <div class="mb-4">
                                <h5>Message Content</h5>
                                <div class="border rounded p-3 bg-light">
                                    <p class="mb-0">{{ $contactMessage->message }}</p>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="mb-4">
                                <h5>Contact Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Name:</strong> {{ $contactMessage->name }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Email:</strong>
                                        <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                                            {{ $contactMessage->email }}
                                        </a>
                                    </div>
                                </div>
                                @if($contactMessage->phone_number)
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <strong>Phone:</strong>
                                            <a href="tel:{{ $contactMessage->phone_number }}" class="text-decoration-none">
                                                {{ $contactMessage->phone_number }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <strong>Subject:</strong> {{ $contactMessage->subject }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Received:</strong> {{ $contactMessage->created_at->format('M d, Y \a\t H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Status Management -->
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Message Status</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('dashboard.contact-messages.update-status', $contactMessage) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Current Status</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="unread" {{ $contactMessage->status === 'unread' ? 'selected' : '' }}>
                                                    Unread
                                                </option>
                                                <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>
                                                    Read
                                                </option>
                                                <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>
                                                    Replied
                                                </option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="admin_notes" class="form-label">Admin Notes</label>
                                            <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control"
                                                      placeholder="Add any internal notes about this message...">{{ $contactMessage->admin_notes }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-save"></i> Update Status
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Quick Actions</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-reply"></i> Reply via Email
                                        </a>
                                        @if($contactMessage->phone_number)
                                            <a href="tel:{{ $contactMessage->phone_number }}"
                                               class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-phone"></i> Call
                                            </a>
                                        @endif
                                        <button type="button" class="btn btn-outline-danger btn-sm delete-message"
                                                data-id="{{ $contactMessage->id }}" data-name="{{ $contactMessage->name }}">
                                            <i class="fas fa-trash"></i> Delete Message
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete message button
    document.querySelector('.delete-message').addEventListener('click', function() {
        const messageId = this.getAttribute('data-id');
        const messageName = this.getAttribute('data-name');

        // Show confirmation dialog
        Swal.fire({
            title: 'Delete Message?',
            text: `Are you sure you want to delete the message from "${messageName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/dashboard/contact-messages/${messageId}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endsection
