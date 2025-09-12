<!-- resources/views/team/events/index.blade.php -->
@extends('layouts.team-dashboard')

@section('title', 'Events')

@section('content')
<div>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Events</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Events</h4>
                    @if(auth()->guard('team')->user()->hasPermission('event.create'))
                    <a href="{{ route('team.events.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($events->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Event Date</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Event Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->order }}</td>
                                        <td>
                                            @if($event->image)
                                                <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $event->title }}</strong>
                                            @if($event->description)
                                                <br><small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $event->formatted_event_date }}</td>
                                        <td>{{ $event->time }}</td>
                                        <td>{{ Str::limit($event->location, 30) }}</td>
                                        <td>
                                            @if($event->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $event->status === 'upcoming' ? 'primary' : ($event->status === 'ongoing' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $event->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group gap-2" role="group">
                                                <a href="{{ route('team.events.show', $event) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                                @if(auth()->guard('team')->user()->hasPermission('event.edit'))
                                                <a href="{{ route('team.events.edit', $event) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                @endif
                                                @if(auth()->guard('team')->user()->hasPermission('event.delete'))
                                                <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                                onclick="confirmDelete('{{ route('team.events.destroy', $event) }}', '{{ $event->title }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $events->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No events found</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(url, title) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to delete the event "${title}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

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
}
</script>
@endsection
