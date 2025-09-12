@extends('layouts.team-dashboard')

@section('title', 'News')

@section('content')
<div>
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('team.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">News</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>News</h4>
                    @if(auth()->guard('team')->user()->hasPermission('news.create'))
                    <a href="{{ route('team.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($news->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($news as $item)
                                        <tr>
                                            <td>
                                                @if($item->image)
                                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                                        class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <img src="/assets/img/placeholder.svg"
                                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('team.news.show', $item) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(auth()->guard('team')->user()->hasPermission('news.edit'))
                                                <a href="{{ route('team.news.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $news->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No News Found</h5>
                            <p class="text-muted">Get started by creating your first news article.</p>
                            @if(auth()->guard('team')->user()->hasPermission('news.create'))
                            <a href="{{ route('team.news.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create News
                            </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
