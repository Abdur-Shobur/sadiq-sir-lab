@extends('layouts.team-dashboard')

@section('title', 'Contact Messages')

@section('content')
<div>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Messages</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Contact Messages</h4>
                </div>
                <div class="card-body">
                    @if($contacts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>
                                                <span class="badge {{ $contact->is_read ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $contact->is_read ? 'Read' : 'Unread' }}
                                                </span>
                                            </td>
                                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('team.contacts.show', $contact) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $contacts->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Contact Messages</h5>
                            <p class="text-muted">No contact messages have been received yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
