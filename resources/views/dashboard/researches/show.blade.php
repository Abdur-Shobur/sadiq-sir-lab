@extends('layouts.admin')

@section('title', 'View Research')

@section('content')
<div  >
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.researches.index') }}">Researches</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Research</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Research Details</h4>
                    <div>
                        <a href="{{ route('dashboard.researches.edit', $research) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit</span>
                        </a>
                        <a href="{{ route('dashboard.researches.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to Researches</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $research->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $research->description }}</td>
                                </tr>
                                <tr>
                                    <th>External Link:</th>
                                    <td>
                                        @if($research->link)
                                            <a href="{{ $research->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-external-link-alt"></i> View Link
                                            </a>
                                        @else
                                            <span class="text-muted">No external link</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $research->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $research->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $research->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $research->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                            </div>

                            @if($research->long_description)
                                <div class="mt-4">
                                    <h5>Detailed Description</h5>
                                    <div class="border p-3 rounded bg-light">
                                        {!! $research->long_description !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if($research->image)
                                <div class="text-center">
                                    <h5>Research Image</h5>
                                    <img src="{{ $research->image_url }}" alt="{{ $research->title }}"
                                         class="img-fluid rounded shadow">
                                </div>
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-image fa-3x mb-3"></i>
                                    <p>No image uploaded</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
