@extends('layouts.team-dashboard')

@section('title', 'Research Details')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('team.researches.index') }}">Researches</a></li>
            <li class="breadcrumb-item active" aria-current="page">Research Details</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Research Details</h4>
                    <div>
                        @if(auth()->guard('team')->user()->hasPermission('research.edit'))
                        <a href="{{ route('team.researches.edit', $research) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @endif
                        <a href="{{ route('team.researches.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($research->image)
                                <img src="{{ $research->image_url }}" alt="{{ $research->title }}" class="img-fluid rounded">
                            @else
                                <img src="/assets/img/placeholder.svg" alt="No Image" class="img-fluid rounded">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $research->title }}</h5>
                            <p class="text-muted">{{ $research->description }}</p>

                            @if($research->link)
                            <p><strong>Link:</strong> <a href="{{ $research->link }}" target="_blank">{{ $research->link }}</a></p>
                            @endif

                            <p><strong>Status:</strong>
                                <span class="badge {{ $research->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $research->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </p>

                            <p><strong>Order:</strong> {{ $research->order }}</p>
                            <p><strong>Created:</strong> {{ $research->created_at->format('M d, Y H:i') }}</p>
                            <p><strong>Updated:</strong> {{ $research->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

```
