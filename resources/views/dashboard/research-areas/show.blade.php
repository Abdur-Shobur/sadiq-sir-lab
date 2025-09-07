@extends('layouts.admin')

@section('title', 'View Research Area')

@section('content')
<div class="mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.research-areas.index') }}">Research Areas</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Research Area</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Research Area Details</h4>
                    <div class="d-flex " style="gap: 8px;">
                        <a href="{{ route('dashboard.research-areas.edit', $researchArea) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit</span>
                        </a>
                        <a href="{{ route('dashboard.research-areas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-borderless" style="white-space:wrap;">
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $researchArea->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $researchArea->description }}</td>
                                </tr>

                                <tr>
                                    <th>Display Order:</th>
                                    <td>{{ $researchArea->order }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($researchArea->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $researchArea->created_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $researchArea->updated_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Image</h6>
                                </div>
                                <div class="card-body text-center">
                                    @if($researchArea->image)
                                        <img src="{{ asset('uploads/' . $researchArea->image) }}"
                                             alt="{{ $researchArea->title }}"
                                             class="img-fluid"
                                             style="max-width: 200px; border-radius: 10px;">
                                    @else
                                        <div class="text-muted">
                                            <i class="fas fa-image fa-3x mb-2"></i>
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
    </div>
</div>
@endsection
