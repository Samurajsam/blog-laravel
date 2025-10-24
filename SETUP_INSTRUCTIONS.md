# Laravel Blog - Setup Instructions

## Implementation Overview

This document provides detailed information about the features implemented in this Laravel blog application.

### 1. Comments System
- ✅ `Comment` model with relationships to `Post` and `User`
- ✅ `CommentController` with CRUD methods
- ✅ Comment validation with custom error messages
- ✅ Comment display in post detail view
- ✅ Add and delete comment functionality

### 2. Admin Panel
- ✅ `UserController` in `Admin` namespace
- ✅ Full CRUD for user management
- ✅ `IsAdmin` middleware to protect admin routes
- ✅ User management views
- ✅ User statistics (post count, comment count)

### 3. Authorization System
- ✅ `PostPolicy` - users can only edit their own posts
- ✅ `CommentPolicy` - users can only delete their own comments
- ✅ Admin has full permissions for all resources
- ✅ `role` column in users table (user/admin)

### 4. Data Validation
- ✅ `StorePostRequest` - post validation
- ✅ `StoreCommentRequest` - comment validation
- ✅ Custom error messages (Polish)
- ✅ Validation in `UserController`

### 5. Model Relationships
- ✅ `User` hasMany `Post` and `Comment`
- ✅ `Post` belongsTo `User` and hasMany `Comment`
- ✅ `Comment` belongsTo `User` and `Post`
- ✅ Eager loading for query optimization

### 6. Routing
- ✅ Public routes for browsing posts
- ✅ Protected routes for creating/editing
- ✅ Separate admin route group with `/admin` prefix

## Installation Steps

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Create First Admin User
You can do this in two ways:

**Option A: Using Database Seeder (Recommended)**
```bash
php artisan db:seed
```
This creates an admin user with:
- Name: `Admin`
- Email: `admin@example.com`
- Password: `password`
- Role: `admin`

**Option B: Using Tinker**
```bash
php artisan tinker
```
Then in tinker:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = Hash::make('password123');
$user->role = 'admin';
$user->save();
```

**Option C: Directly in Database**
After registering through the form, change the `role` column value to `'admin'` for your user.

### 3. (Optional) Generate Test Data
You can create factories for posts and comments:

```bash
php artisan make:factory PostFactory
php artisan make:factory CommentFactory
```

### 4. Start the Server
```bash
php artisan serve
```

## Project Structure

### Models
- `app/Models/User.php` - users with roles
- `app/Models/Post.php` - blog posts
- `app/Models/Comment.php` - comments

### Controllers
- `app/Http/Controllers/PostController.php` - post management
- `app/Http/Controllers/CommentController.php` - comment management
- `app/Http/Controllers/Admin/UserController.php` - admin panel

### Middleware
- `app/Http/Middleware/IsAdmin.php` - checks if user is admin

### Policies
- `app/Policies/PostPolicy.php` - authorization for posts
- `app/Policies/CommentPolicy.php` - authorization for comments

### Request Classes
- `app/Http/Requests/StorePostRequest.php` - post validation
- `app/Http/Requests/StoreCommentRequest.php` - comment validation

### Views
- `resources/views/posts/` - post views
- `resources/views/admin/users/` - admin panel
- `resources/views/layouts/navigation.blade.php` - navigation with links

## Features

### For Regular Users:
- ✅ Browse posts (public)
- ✅ Create own posts
- ✅ Edit and delete own posts
- ✅ Add comments
- ✅ Delete own comments

### For Administrators:
- ✅ All user permissions
- ✅ Edit and delete all posts
- ✅ Delete all comments
- ✅ User management (CRUD)
- ✅ Change user roles
- ✅ Access to admin panel

## Security Features

- ✅ CSRF protection on all forms
- ✅ Password hashing
- ✅ Authorization through Policies
- ✅ Middleware for admin routes
- ✅ Input data validation
- ✅ XSS protection (Blade escaping)

## API Endpoints

### Public Routes
- `GET /posts` - List all posts
- `GET /posts/{post}` - View single post

### Authenticated Routes
- `GET /posts/create` - Create post form
- `POST /posts` - Store new post
- `GET /posts/{post}/edit` - Edit post form
- `PUT /posts/{post}` - Update post
- `DELETE /posts/{post}` - Delete post
- `POST /comments` - Add comment
- `DELETE /comments/{comment}` - Delete comment

### Admin Routes (requires admin role)
- `GET /admin/users` - List users
- `GET /admin/users/create` - Create user form
- `POST /admin/users` - Store new user
- `GET /admin/users/{user}/edit` - Edit user form
- `PUT /admin/users/{user}` - Update user
- `DELETE /admin/users/{user}` - Delete user

## Database Schema

### Users Table
```sql
- id (bigint, primary key)
- name (varchar)
- email (varchar, unique)
- password (varchar, hashed)
- role (varchar, default: 'user')
- email_verified_at (timestamp, nullable)
- remember_token (varchar, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### Posts Table
```sql
- id (bigint, primary key)
- user_id (bigint, foreign key -> users.id, cascade on delete)
- title (varchar)
- body (text)
- created_at (timestamp)
- updated_at (timestamp)
```

### Comments Table
```sql
- id (bigint, primary key)
- post_id (bigint, foreign key -> posts.id, cascade on delete)
- user_id (bigint, foreign key -> users.id, cascade on delete)
- content (text)
- created_at (timestamp)
- updated_at (timestamp)
```

## Testing

### Manual Testing Checklist

#### Authentication
- [ ] User can register
- [ ] User can login
- [ ] User can logout
- [ ] Password reset works

#### Posts
- [ ] User can view all posts
- [ ] User can view single post
- [ ] Authenticated user can create post
- [ ] User can edit own post
- [ ] User cannot edit other user's post
- [ ] Admin can edit any post
- [ ] User can delete own post
- [ ] Admin can delete any post

#### Comments
- [ ] Authenticated user can add comment
- [ ] User can delete own comment
- [ ] Admin can delete any comment
- [ ] Comments display correctly

#### Admin Panel
- [ ] Only admin can access `/admin/users`
- [ ] Admin can view all users
- [ ] Admin can create new user
- [ ] Admin can edit user
- [ ] Admin can delete user (except self)
- [ ] Admin can change user roles

## Troubleshooting

### Common Issues

**Issue: "Call to undefined method authorize()"**
- Solution: Ensure `Controller` class uses `AuthorizesRequests` trait

**Issue: "Access denied to admin panel"**
- Solution: Check if user has `role = 'admin'` in database

**Issue: "Validation errors not showing"**
- Solution: Check if Form Request classes are properly imported

**Issue: "Comments not displaying"**
- Solution: Ensure relationships are loaded with `->load()` or `->with()`

## Future Enhancements

1. **Post Categories** - Add category system
2. **Tags** - Many-to-many relationship for tags
3. **Search** - Add post search functionality
4. **Comment Pagination** - For posts with many comments
5. **Edit Comments** - Add comment editing capability
6. **Soft Deletes** - Soft delete resources
7. **REST API** - API for mobile applications
8. **Tests** - Unit and feature tests
9. **Notifications** - Email notifications for new comments
10. **Images** - Image upload for posts
11. **Post Drafts** - Save posts as drafts
12. **Social Sharing** - Share posts on social media
13. **User Profiles** - Extended user profile pages
14. **Post Likes** - Like/unlike posts
15. **Comment Replies** - Nested comment threads

## Notes

- Project uses Laravel Breeze for authentication
- Styling with Tailwind CSS
- MVC structure is maintained
- Error messages are in Polish (can be changed in Request classes)
- Uses session-based authentication (not JWT)
