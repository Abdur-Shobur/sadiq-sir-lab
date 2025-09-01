@extends('layouts.admin')

@section('title', 'Publications Management')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Publications</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Publications Management</h4>
                    <a href="{{ route('dashboard.publications.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Publication
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($publications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publication Date</th>
                                        <th>Journal</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($publications as $publication)
                                    <tr>
                                        <td>
                                            <strong>{{ $publication->title }}</strong>
                                            @if($publication->subtitle)
                                                <br><small class="text-muted">{{ $publication->subtitle }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $publication->author }}</td>
                                        <td>{{ $publication->publication_date->format('M d, Y') }}</td>
                                        <td>{{ $publication->journal ?? 'N/A' }}</td>
                                        <td>
                                            @if($publication->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('dashboard.publications.show', $publication) }}"
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('dashboard.publications.edit', $publication) }}"
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('dashboard.publications.destroy', $publication) }}"
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this publication?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No publications found</h5>
                            <p class="text-muted">Start by adding your first publication.</p>
                            <a href="{{ route('dashboard.publications.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Publication
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
