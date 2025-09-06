@extends('layouts.admin')

@section('title', 'Contact Messages - Dashboard')

@section('content')
<div  >
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Contact Messages</h4>
                    <div class="d-flex align-items-center">
                        @if($unreadCount > 0)
                            <span class="badge bg-danger me-3">{{ $unreadCount }} Unread</span>
                        @endif
                        <div class="btn-group" role="group">
                            <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-outline-primary {{ request()->get('filter') == '' ? 'active' : '' }}">
                                All
                            </a>
                            <a href="{{ route('dashboard.contact-messages.index', ['filter' => 'unread']) }}" class="btn btn-outline-primary {{ request()->get('filter') == 'unread' ? 'active' : '' }}">
                                Unread
                            </a>
                            <a href="{{ route('dashboard.contact-messages.index', ['filter' => 'read']) }}" class="btn btn-outline-primary {{ request()->get('filter') == 'read' ? 'active' : '' }}">
                                Read
                            </a>
                            <a href="{{ route('dashboard.contact-messages.index', ['filter' => 'replied']) }}" class="btn btn-outline-primary {{ request()->get('filter') == 'replied' ? 'active' : '' }}">
                                Replied
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $message)
                                    <tr class="{{ $message->status === 'unread' ? 'table-warning' : '' }}">
                                        <td>{{ $message->id }}</td>
                                        <td>
                                            <strong>{{ $message->name }}</strong>
                                            @if($message->phone_number)
                                                <br><small class="text-muted">{{ $message->phone_number }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                                {{ $message->email }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ Str::limit($message->subject, 50) }}
                                        </td>
                                        <td>
                                            {!! $message->status_badge !!}
                                        </td>
                                        <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.contact-messages.show', $message) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger delete-message"
                                                    data-id="{{ $message->id }}" data-name="{{ $message->name }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No contact messages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($messages->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete message buttons
    document.querySelectorAll('.delete-message').forEach(button => {
        button.addEventListener('click', function() {
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
});
</script>
@endsection
