@extends('layouts.admin')

@section('title', 'View Portfolio Banner')

@section('content')
<div  >
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-2">
                    <h3 class="card-title">Portfolio Details</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.portfolio-banners.edit', $portfolioBanner) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit Banner</span>
                        </a>
                        <a href="{{ route('dashboard.portfolio-banners.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                           <div class="table-responsive" >
                             <table class="table table-borderless">
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $portfolioBanner->title }}</td>
                                </tr>
                                <tr>
                                    <th>Subtitle:</th>
                                    <td>{{ $portfolioBanner->subtitle ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $portfolioBanner->description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Additional Text:</th>
                                    <td>{{ $portfolioBanner->additional_text ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Order:</th>
                                    <td>{{ $portfolioBanner->order }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $portfolioBanner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $portfolioBanner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $portfolioBanner->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $portfolioBanner->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                           </div>
                        </div>
                        <div class="col-md-4">
                            @if($portfolioBanner->image)
                                <div class="text-center">
                                    <h5>Banner Image</h5>
                                    <img src="{{ $portfolioBanner->image_url }}" alt="{{ $portfolioBanner->title }}"
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
