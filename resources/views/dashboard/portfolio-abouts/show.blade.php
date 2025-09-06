@extends('layouts.admin')

@section('title', 'View Portfolio About')

@section('content')
<div >
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Portfolio Details</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.portfolio-abouts.edit', $portfolioAbout) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                            <span class="d-none d-lg-inline-block">Edit About</span>
                        </a>
                        <a href="{{ route('dashboard.portfolio-abouts.index') }}" class="btn btn-secondary">
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
                                    <td>{{ $portfolioAbout->title }}</td>
                                </tr>
                                <tr>
                                    <th>Subtitle:</th>
                                    <td>{{ $portfolioAbout->subtitle ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $portfolioAbout->description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $portfolioAbout->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $portfolioAbout->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $portfolioAbout->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated:</th>
                                    <td>{{ $portfolioAbout->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    @if($portfolioAbout->image1)
                                        <div class="text-center">
                                            <h5>Image 1</h5>
                                            <img src="{{ $portfolioAbout->image1_url }}" alt="{{ $portfolioAbout->title }}"
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-2x mb-2"></i>
                                            <p>No image 1 uploaded</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    @if($portfolioAbout->image2)
                                        <div class="text-center">
                                            <h5>Image 2</h5>
                                            <img src="{{ $portfolioAbout->image2_url }}" alt="{{ $portfolioAbout->title }}"
                                                 class="img-fluid rounded shadow">
                                        </div>
                                    @else
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-2x mb-2"></i>
                                            <p>No image 2 uploaded</p>
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
