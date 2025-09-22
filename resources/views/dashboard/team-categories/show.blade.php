@extends('layouts.admin')

@section('content')
<div>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.team-categories.index') }}">Team Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $teamCategory->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $teamCategory->title }}</h4>
                        @if($teamCategory->description)
                            <p class="text-muted mb-0">{{ $teamCategory->description }}</p>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('dashboard.team-categories.edit', $teamCategory) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Category
                        </a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTeamMembersModal">
                            <i class="fas fa-user-plus"></i> Add Team Members
                        </button>
                        <a href="{{ route('dashboard.teams.create') }}?category={{ $teamCategory->id }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Team Member
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($teamCategory->teams->count() > 0)
                        <div class="mb-3">
                            <h5>Team Members ({{ $teamCategory->teams->count() }})</h5>
                            <p class="text-muted">Drag and drop to reorder team members within this category.</p>
                        </div>

                        <div id="sortable-teams" class="row">
                            @foreach($teamCategory->teams as $team)
                            <div class="col-md-6 col-lg-4 mb-3" data-team-id="{{ $team->id }}">
                                <div class="card team-member-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($team->image)
                                                    <img src="{{ $team->image_url }}" alt="{{ $team->name }}"
                                                         class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/img/placeholder.svg') }}" alt="{{ $team->name }}"
                                                         class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $team->name }}</h6>
                                                <p class="text-muted mb-1">{{ $team->designation }}</p>
                                                <div class="d-flex align-items-center gap-2">
                                                    <small class="text-muted">Order:</small>
                                                    <span class="badge bg-primary">{{ $team->sort_order }}</span>
                                                </div>
                                            </div>
                                            <button class="btn btn-sm btn-outline-secondary" onclick="removeFromCategory({{ $team->id }}, '{{ $team->name }}')">
                                                <i class="fas fa-times"></i> Remove
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Team Members in This Category</h4>
                            <p class="text-muted">Add team members to this category to get started.</p>
                            <a href="{{ route('dashboard.teams.create') }}?category={{ $teamCategory->id }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add First Team Member
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Team Members Modal -->
<div class="modal fade" id="addTeamMembersModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Team Members to {{ $teamCategory->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('dashboard.team-categories.add-team-members', $teamCategory) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Team Members to Add</label>
                        <div class="border rounded p-3" style="max-height: 400px; overflow-y: auto;" id="availableTeamsContainer">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Loading available team members...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="addTeamMembersBtn" disabled>
                        <i class="fas fa-user-plus"></i> Add Selected Members
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove from Category Modal -->
<div class="modal fade" id="removeFromCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove Team Member from Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove <strong id="teamNameToRemove"></strong> from this category?</p>
                <p class="text-muted">The team member will still exist but won't be part of this category.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmRemoveFromCategory">Remove from Category</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sortable for team members
    const sortableElement = document.getElementById('sortable-teams');
    if (sortableElement) {
        const sortable = Sortable.create(sortableElement, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                // Update order in database
                const teamIds = [];
                sortableElement.querySelectorAll('[data-team-id]').forEach(function(item) {
                    teamIds.push(parseInt(item.getAttribute('data-team-id')));
                });

                // Send AJAX request to update order
                fetch(`{{ route('dashboard.team-categories.update-team-order', $teamCategory) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        team_orders: teamIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showToast('Team member order updated successfully!', 'success');

                        // Update sort order display
                        sortableElement.querySelectorAll('[data-team-id]').forEach(function(item, index) {
                            const orderBadge = item.querySelector('.badge.bg-primary');
                            if (orderBadge) {
                                orderBadge.textContent = index + 1;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating team order:', error);
                    showToast('Error updating team member order. Please try again.', 'error');
                });
            }
        });
    }

    // Load available teams when modal is shown
    const addTeamMembersModal = document.getElementById('addTeamMembersModal');
    if (addTeamMembersModal) {
        addTeamMembersModal.addEventListener('show.bs.modal', function() {
            loadAvailableTeams();
        });
    }
});

function loadAvailableTeams() {
    const container = document.getElementById('availableTeamsContainer');
    const addBtn = document.getElementById('addTeamMembersBtn');

    fetch(`{{ route('dashboard.team-categories.available-teams', $teamCategory) }}`)
        .then(response => response.json())
        .then(teams => {
            if (teams.length > 0) {
                let html = `
                    <div class="mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="select-all-available-teams">
                            <label class="form-check-label fw-bold" for="select-all-available-teams">
                                Select All Available Team Members
                            </label>
                        </div>
                    </div>
                    <div class="row">
                `;

                teams.forEach(team => {
                    const isCurrentMember = team.category_id == {{ $teamCategory->id }};
                    html += `
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input available-team-checkbox" type="checkbox"
                                       name="team_members[]" value="${team.id}"
                                       id="available_team_${team.id}"
                                       ${isCurrentMember ? 'checked disabled' : ''}>
                                <label class="form-check-label d-flex align-items-center" for="available_team_${team.id}">
                                    <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                         style="width: 30px; height: 30px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">${team.name}</div>
                                        <small class="text-muted">${team.designation}</small>
                                        ${isCurrentMember ? '<small class="text-success">(Current member)</small>' : ''}
                                    </div>
                                </label>
                            </div>
                        </div>
                    `;
                });

                html += '</div>';
                container.innerHTML = html;

                // Add event listeners for checkboxes
                setupAvailableTeamCheckboxes();
            } else {
                container.innerHTML = `
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <p>No available team members to add.</p>
                        <a href="{{ route('dashboard.teams.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Create Team Member
                        </a>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading available teams:', error);
            container.innerHTML = `
                <div class="text-center text-danger py-3">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <p>Error loading available team members. Please try again.</p>
                </div>
            `;
        });
}

function setupAvailableTeamCheckboxes() {
    const selectAllCheckbox = document.getElementById('select-all-available-teams');
    const teamCheckboxes = document.querySelectorAll('.available-team-checkbox:not([disabled])');
    const addBtn = document.getElementById('addTeamMembersBtn');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            teamCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateAddButton();
        });
    }

    teamCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.available-team-checkbox:checked:not([disabled])').length;
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = checkedCount === teamCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < teamCheckboxes.length;
            }
            updateAddButton();
        });
    });

    function updateAddButton() {
        const checkedCount = document.querySelectorAll('.available-team-checkbox:checked:not([disabled])').length;
        addBtn.disabled = checkedCount === 0;
    }
}

function removeFromCategory(teamId, teamName) {
    document.getElementById('teamNameToRemove').textContent = teamName;
    document.getElementById('confirmRemoveFromCategory').onclick = function() {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `{{ url('dashboard/team-categories/' . $teamCategory->id . '/teams') }}/${teamId}`;

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
    };

    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('removeFromCategoryModal'));
    modal.show();
}

function showToast(message, type) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    // Add to page
    document.body.appendChild(toast);

    // Show toast
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    // Remove after hidden
    toast.addEventListener('hidden.bs.toast', function() {
        toast.remove();
    });
}
</script>

<style>
.sortable-ghost {
    opacity: 0.4;
}

.sortable-chosen {
    transform: scale(1.05);
}

.sortable-drag {
    transform: rotate(5deg);
}

.team-member-card {
    cursor: move;
    transition: all 0.3s ease;
}

.team-member-card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}
</style>
@endpush
