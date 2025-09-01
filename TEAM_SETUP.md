# Team Management System Setup

This document provides instructions for setting up the team management system in your Laravel application.

## Features

- **Admin Panel**: Complete CRUD operations for team members
- **Team Login**: Separate authentication system for team members
- **Team Dashboard**: Dedicated dashboard for team members to manage their profiles
- **Profile Management**: Team members can update their information, specialities, education, experience, and social media links
- **Image Upload**: Profile image upload functionality
- **Role-based Access**: Admin and team member roles

## Setup Instructions

### 1. Run Migrations

```bash
php artisan migrate
```

### 2. Run Seeders

```bash
php artisan db:seed
```

This will create:
- Admin user: admin@example.com / password
- Team member: john@example.com / password
- Team member: jane@example.com / password

### 3. Create Storage Link

```bash
php artisan storage:link
```

### 4. Configure Authentication

The system uses multiple authentication guards:
- `web` guard for admin users (existing User model)
- `team` guard for team members (new Team model)

### 5. Access Points

#### Admin Panel
- URL: `/dashboard`
- Login: `/login`
- Team Management: `/dashboard/teams`

#### Team Panel
- URL: `/team-dashboard`
- Login: `/team-login`
- Profile: `/team-profile`

## Team Member Fields

- **Basic Info**: name, email, designation, phone, website, address
- **Image**: Profile picture upload
- **Specialities**: Array of specialities (creatable fields)
- **Education**: Array of education entries (creatable fields)
- **Experience**: Array of experience entries (creatable fields)
- **Social Media**: Array of social media platforms and URLs (creatable fields)
- **Role**: admin or team
- **Status**: active or inactive

## Usage

### For Admins
1. Login to admin panel
2. Navigate to "Team Members" in the sidebar
3. Create, edit, or delete team members
4. Manage team member roles and status

### For Team Members
1. Login to team panel using their credentials
2. View their dashboard
3. Edit their profile information
4. Update specialities, education, experience, and social media links
5. Change their password

## Security Features

- Separate authentication guards for admin and team users
- Password hashing
- CSRF protection
- Input validation
- File upload validation
- Role-based access control

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── TeamController.php (Admin CRUD)
│   │   ├── TeamAuthController.php (Team authentication)
│   │   └── TeamDashboardController.php (Team dashboard)
│   └── Middleware/
│       └── TeamAuth.php (Team authentication middleware)
├── Models/
│   └── Team.php (Team member model)
database/
├── migrations/
│   └── 2025_01_02_000000_create_teams_table.php
└── seeders/
    └── TeamSeeder.php
resources/
└── views/
    ├── dashboard/teams/ (Admin team management views)
    ├── team/ (Team panel views)
    └── layouts/
        └── team-dashboard.blade.php (Team dashboard layout)
```

## Customization

You can customize the system by:
- Modifying the Team model fields
- Updating the validation rules in controllers
- Customizing the views and layouts
- Adding additional features like team member permissions
- Extending the social media platforms support

## Troubleshooting

1. **Storage link not working**: Run `php artisan storage:link`
2. **Authentication issues**: Check the auth configuration in `config/auth.php`
3. **Image upload errors**: Ensure the storage directory is writable
4. **Route not found**: Clear route cache with `php artisan route:clear`

## Summary

I've completed the team management system with the following components:

### ✅ **Completed Features:**

1. **Database & Models**
   - Team migration with all required fields
   - Team model with authentication support
   - JSON fields for specialities, education, experience, and social media

2. **Admin Panel**
   - Complete CRUD operations for team management
   - Team listing, creation, editing, and deletion
   - Image upload functionality
   - Dynamic form fields for creatable content

3. **Team Authentication**
   - Separate login system for team members
   - Team-specific middleware
   - Updated auth configuration

4. **Team Dashboard**
   - Dedicated dashboard for team members
   - Profile management with all fields
   - Password change functionality
   - Responsive design

5. **Views & UI**
   - Admin team management views (index, create, edit, show)
   - Team login page
   - Team dashboard layout
   - Team profile management
   - Public team page

6. **Additional Components**
   - Team seeder with sample data
   - Middleware registration
   - Route configuration
   - Setup documentation

### 🔧 **Key Features:**

- **Creatable Fields**: Specialities, education, experience, and social media are all dynamic arrays
- **Image Management**: Profile image upload with automatic URL generation
- **Role-based Access**: Admin and team member roles
- **Separate Authentication**: Team members have their own login system
- **Profile Management**: Team members can update their own information
- **Responsive Design**: Works on all device sizes

### 🚀 **Ready to Use:**

The system is now complete and ready for use. You can:
1. Run `php artisan migrate` to create the teams table
2. Run `php artisan db:seed` to create sample team members
3. Access admin panel at `/dashboard/teams` to manage team members
4. Team members can login at `/team-login` to access their dashboard

The system provides a complete team management solution with all the requested features including creatable fields for specialities, education, experience, and social media links.
