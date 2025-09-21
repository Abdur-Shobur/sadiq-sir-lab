@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.team-categories.index') }}">Team Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Category</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Team Category</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.team-categories.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Team Members</label>
                                    <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                        @if($availableTeams->count() > 0)
                                            <div class="mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="select-all-teams">
                                                    <label class="form-check-label fw-bold" for="select-all-teams">
                                                        Select All Available Team Members
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row" id="team-members-container">
                                                @foreach($availableTeams as $team)
                                                <div class="col-md-6 mb-3 team-member-row" data-team-id="{{ $team->id }}" style="display: none;">
                                                    <div class="card">
                                                        <div class="card-body p-3">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input team-member-checkbox" type="checkbox"
                                                                       name="team_members[]" value="{{ $team->id }}"
                                                                       id="team_{{ $team->id }}"
                                                                       {{ in_array($team->id, old('team_members', [])) ? 'checked' : '' }}>
                                                                <label class="form-check-label d-flex align-items-center" for="team_{{ $team->id }}">
                                                                    @if($team->image)
                                                                        <img src="{{ $team->image_url }}" alt="{{ $team->name }}"
                                                                             class="rounded-circle me-2" width="30" height="30" style="object-fit: cover;">
                                                                    @else
                                                                        <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                                             style="width: 30px; height: 30px;">
                                                                            <i class="fas fa-user text-white"></i>
                                                                        </div>
                                                                    @endif
                                                                    <div>
                                                                        <div class="fw-bold">{{ $team->name }}</div>
                                                                        <small class="text-muted">{{ $team->designation }}</small>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-6">
                                                                    <label for="sort_order_{{ $team->id }}" class="form-label small">Sort Order</label>
                                                                    <input type="number" class="form-control form-control-sm sort-order-input"
                                                                           name="sort_orders[{{ $team->id }}]"
                                                                           id="sort_order_{{ $team->id }}"
                                                                           value="{{ old('sort_orders.'.$team->id, '') }}"
                                                                           min="1" placeholder="Order">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="form-label small">Preview</label>
                                                                    <div class="badge bg-secondary sort-preview" id="preview_{{ $team->id }}">-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center text-muted py-3">
                                                <i class="fas fa-users fa-2x mb-2"></i>
                                                <p>No available team members to assign.</p>
                                                <a href="{{ route('dashboard.teams.create') }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-plus"></i> Create Team Member
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    @error('team_members')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                           id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Lower numbers appear first</div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                               value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-text">Inactive categories won't be displayed on the frontend</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard.team-categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all-teams');
    const teamMemberCheckboxes = document.querySelectorAll('.team-member-checkbox');
    const teamMemberRows = document.querySelectorAll('.team-member-row');
    const sortOrderInputs = document.querySelectorAll('.sort-order-input');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            teamMemberCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
                toggleTeamMemberRow(checkbox);
            });
        });

        // Update select all checkbox based on individual selections
        teamMemberCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                toggleTeamMemberRow(this);
                const checkedCount = document.querySelectorAll('.team-member-checkbox:checked').length;
                selectAllCheckbox.checked = checkedCount === teamMemberCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < teamMemberCheckboxes.length;
            });
        });
    }

    // Handle sort order inputs
    sortOrderInputs.forEach(input => {
        input.addEventListener('input', function() {
            updateSortPreview(this);
            autoAssignSortOrders();
        });
    });

    function toggleTeamMemberRow(checkbox) {
        const teamId = checkbox.value;
        const row = document.querySelector(`[data-team-id="${teamId}"]`);
        if (row) {
            row.style.display = checkbox.checked ? 'block' : 'none';
            if (checkbox.checked) {
                // Auto-assign sort order if not set
                const sortInput = row.querySelector('.sort-order-input');
                if (sortInput && !sortInput.value) {
                    autoAssignSortOrders();
                }
            }
        }
    }

    function updateSortPreview(input) {
        const teamId = input.name.match(/\[(\d+)\]/)[1];
        const preview = document.getElementById(`preview_${teamId}`);
        if (preview) {
            const value = input.value || '-';
            preview.textContent = value;
            preview.className = `badge ${value === '-' ? 'bg-secondary' : 'bg-primary'} sort-preview`;
        }
    }

    function autoAssignSortOrders() {
        const checkedInputs = document.querySelectorAll('.team-member-checkbox:checked');
        const sortInputs = Array.from(document.querySelectorAll('.sort-order-input')).filter(input => {
            const teamId = input.name.match(/\[(\d+)\]/)[1];
            const checkbox = document.getElementById(`team_${teamId}`);
            return checkbox && checkbox.checked;
        });

        // Get current sort orders
        const currentOrders = sortInputs.map(input => parseInt(input.value) || 0).filter(order => order > 0);
        const maxOrder = Math.max(...currentOrders, 0);

        // Auto-assign orders for inputs without values
        sortInputs.forEach((input, index) => {
            if (!input.value) {
                input.value = maxOrder + index + 1;
                updateSortPreview(input);
            }
        });
    }

    // Initialize display for pre-checked items
    teamMemberCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            toggleTeamMemberRow(checkbox);
        }
    });
});
</script>
@endpush
