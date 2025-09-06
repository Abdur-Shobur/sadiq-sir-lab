@extends('layouts.admin')

@section('title', 'View Social Media Link')

@section('content')
<div class="">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex gap-2 justify-content-between align-items-center">
                    <h3 class="card-title">Details</h3>
                    <div class="card-tools ">
                        <a href="{{ route('dashboard.social-media.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            <span class="d-none d-lg-inline-block">Back to List</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive" style="white-space: wrap;">
                                <table class="table table-bordered">
                                <tr>
                                    <th width="200">ID:</th>
                                    <td>{{ $socialMedia->id }}</td>
                                </tr>
                                <tr>
                                    <th>Platform:</th>
                                    <td>
                                        <i class="{{ $socialMedia->getIconClass() }}"></i>
                                        {{ ucfirst($socialMedia->platform) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>URL:</th>
                                    <td>
                                        <a href="{{ $socialMedia->url }}" target="_blank" class="text-primary">
                                            {{ $socialMedia->url }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($socialMedia->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $socialMedia->created_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At:</th>
                                    <td>{{ $socialMedia->updated_at->format('F d, Y \a\t g:i A') }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('dashboard.social-media.edit', $socialMedia->id) }}"
                                           class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ $socialMedia->url }}" target="_blank"
                                           class="btn btn-info">
                                            <i class="fas fa-external-link-alt"></i> Visit Link
                                        </a>
                                        <button type="button" class="btn btn-danger delete-btn"
                                                data-id="{{ $socialMedia->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete button
    document.querySelector('.delete-btn').addEventListener('click', function() {
        const socialMediaId = this.getAttribute('data-id');
        const platformName = '{{ ucfirst($socialMedia->platform) }}';

        // Show confirmation toast
        Swal.fire({
            title: 'Delete Social Media?',
            text: `Are you sure you want to delete "${platformName}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/dashboard/social-media/${socialMediaId}`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endsection
