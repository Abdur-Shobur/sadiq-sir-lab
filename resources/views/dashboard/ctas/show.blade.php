@extends('layouts.admin')

@section('title', 'View CTA')

@section('content')
<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.ctas.index') }}">CTA</a></li>
            <li class="breadcrumb-item active" aria-current="page">View CTA</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>CTA Details</h4>
                    <div>
                        <a href="{{ route('dashboard.ctas.edit', $cta) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('dashboard.ctas.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $cta->title }}</td>
                                </tr>
                                <tr>
                                    <th>Subtitle:</th>
                                    <td>{{ $cta->subtitle ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $cta->description }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number:</th>
                                    <td>{{ $cta->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Button Text:</th>
                                    <td>{{ $cta->button_text }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($cta->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $cta->created_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $cta->updated_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Frontend Preview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="cta-preview">
                                        <h3 class="mb-2">{{ $cta->title }}</h3>
                                        @if($cta->subtitle)
                                            <h4 class="text-muted mb-3">{{ $cta->subtitle }}</h4>
                                        @endif
                                        <p class="mb-3">{{ $cta->description }}</p>
                                        <h2 class="mb-3"><a href="tel:{{ $cta->phone_number }}">{{ $cta->phone_number }}</a></h2>
                                        <a href="{{ route('contact') }}" class="btn btn-primary">{{ $cta->button_text }}</a>
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
@endsection
