@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Newsletter Subscribers</h1>
    <div>
        <a href="{{ route('dashboard.newsletter-subscribers.export') }}" class="btn btn-success btn-sm">
            <i class="fas fa-download"></i> Export CSV
        </a>
        <a href="{{ route('dashboard.newsletter-subscribers.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add Subscriber
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Subscribers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Subscribers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Inactive Subscribers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['inactive'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-pause-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Unsubscribed</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['unsubscribed'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Subscribers Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Subscribers List</h6>
    </div>
    <div class="card-body">
        @if($subscribers->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Subscribed At</th>
                            <th>Unsubscribed At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->id }}</td>
                                <td>{{ $subscriber->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $subscriber->status === 'active' ? 'success' : ($subscriber->status === 'inactive' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($subscriber->status) }}
                                    </span>
                                </td>
                                <td>{{ $subscriber->subscribed_at?->format('M j, Y g:i A') ?? 'N/A' }}</td>
                                <td>{{ $subscriber->unsubscribed_at?->format('M j, Y g:i A') ?? 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.newsletter-subscribers.edit', $subscriber) }}">
                                                    <i class="fas fa-edit "></i>
                                                </a>
                                                <a class="btn btn-sm btn-info" href="{{ route('dashboard.newsletter-subscribers.show', $subscriber) }}">
                                                    <i class="fas fa-eye "></i>
                                                </a>
                                                <form action="{{ route('dashboard.newsletter-subscribers.destroy', $subscriber) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this subscriber?')">
                                                        <i class="fas fa-trash "></i>
                                                    </button>
                                                </form>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $subscribers->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-envelope fa-3x text-gray-300 mb-3"></i>
                <h5 class="text-gray-500">No subscribers found</h5>
                <p class="text-gray-400">Start building your newsletter list by adding the first subscriber.</p>
                <a href="{{ route('dashboard.newsletter-subscribers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add First Subscriber
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize DataTable if you have it
    $(document).ready(function() {
        if ($.fn.DataTable) {
            $('#dataTable').DataTable({
                "order": [[ 0, "desc" ]]
            });
        }
    });
</script>
@endpush
