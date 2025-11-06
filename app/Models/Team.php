<?php
namespace App\Models;

use App\Notifications\TeamResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Team extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    protected $fillable = [
        'name',
        'image',
        'designation',
        'specialities',
        'education',
        'experience',
        'address',
        'phone',
        'email',
        'website',
        'social_media',
        'password',
        'role',
        'is_active',
        'category_id',
        'sort_order',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'specialities' => 'array',
            'education'    => 'array',
            'experience'   => 'array',
            'social_media' => 'array',
            'is_active'    => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    // Role relationships
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'team_roles');
    }

    // Get permissions available to this team via assigned roles
    public function permissions(): \Illuminate\Database\Eloquent\Builder
    {
        return Permission::query()
            ->select('permissions.*')
            ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->join('team_roles', 'role_permissions.role_id', '=', 'team_roles.role_id')
            ->where('team_roles.team_id', $this->id);
    }

    // Check if team has a specific role
    public function hasRole($role): bool
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('slug', $role)->exists();
        }
        return $this->roles()->where('slug', $role)->exists();
    }

    // Check if team has a specific permission
    // Check if team has a specific permission
    public function hasPermission($permission): bool
    {
        // If team has admin role, they have all permissions
        if ($this->hasRole('admin')) {
            return true;
        }

        return $this->permissions()
            ->where('permissions.slug', $permission)
            ->exists();
    }

    // Get all permissions for this team
    // Get all permissions for this team
    public function getAllPermissions(): array
    {
        if ($this->hasRole('admin')) {
            return Permission::pluck('slug')->toArray();
        }

        return $this->permissions()
            ->distinct()
            ->pluck('permissions.slug')
            ->toArray();
    }
    // Assign role to team
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->first();
        }

        if ($role && ! $this->hasRole($role->slug)) {
            $this->roles()->attach($role->id);
        }
    }

    // Remove role from team
    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->first();
        }

        if ($role) {
            $this->roles()->detach($role->id);
        }
    }

    // Sync roles for team
    public function syncRoles($roles)
    {
        $roleIds = [];

        foreach ($roles as $role) {
            if (is_string($role)) {
                $roleModel = Role::where('slug', $role)->first();
                if ($roleModel) {
                    $roleIds[] = $roleModel->id;
                }
            } else {
                $roleIds[] = $role->id;
            }
        }

        $this->roles()->sync($roleIds);
    }

    // Legacy methods for backward compatibility
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isTeamMember(): bool
    {
        return $this->hasRole('team_member');
    }

    public function isAdvisor(): bool
    {
        return $this->hasRole('advisor');
    }

    // Get role permissions (legacy method for backward compatibility)
    public function getRolePermissions(): array
    {
        return $this->getAllPermissions();
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('uploads/' . $this->image);
        }
        return asset('assets/img/default-avatar.png');
    }

    // Category relationship
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TeamCategory::class, 'category_id');
    }

    /**
     * Check if this team is featured on home page
     */
    public function isOnHomePage(): bool
    {
        return $this->homeTeam()->exists();
    }

    /**
     * Get the home team entry for this team
     */
    public function homeTeam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(HomeTeam::class);
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TeamResetPassword($token));
    }
}
