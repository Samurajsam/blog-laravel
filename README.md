# Laravel Blog with Admin Panel

A full-featured blog application built with Laravel 11, featuring user authentication, post management, comments system, and a comprehensive admin panel.

## Features

### 🔐 Authentication & Authorization
- User registration and login (Laravel Breeze)
- Role-based access control (User/Admin)
- Policy-based authorization for posts and comments
- Protected admin routes with custom middleware

### 📝 Blog Posts
- Create, read, update, and delete posts (CRUD)
- Rich text content support
- Author attribution
- Users can only edit/delete their own posts
- Admins can manage all posts
- Pagination support

### 💬 Comments System
- Add comments to posts
- Delete own comments
- Admins can delete any comment
- Real-time comment count display
- Nested comment display with user information

### 👥 Admin Panel
- User management (CRUD operations)
- View user statistics (posts count, comments count)
- Change user roles (User/Admin)
- Password management
- Protected by admin middleware

### ✅ Data Validation
- Custom Form Request classes
- Polish language error messages
- Server-side validation for all inputs
- XSS protection

### 🎨 UI/UX
- Responsive design with Tailwind CSS
- Dark mode support
- Clean and modern interface
- Intuitive navigation
- Success/error message notifications

## Tech Stack

- **Framework:** Laravel 11
- **Authentication:** Laravel Breeze
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL/PostgreSQL/SQLite
- **PHP Version:** 8.2+

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite database

### Setup Steps

1. **Clone the repository**
```bash
git clone <repository-url>
cd blog-laravel
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install NPM dependencies**
```bash
npm install
```

4. **Create environment file**
```bash
cp .env.example .env
```

5. **Generate application key**
```bash
php artisan key:generate
```

6. **Configure database**
Edit `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_laravel
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Seed the database (optional)**
```bash
php artisan db:seed
```
This creates an admin user:
- Email: `admin@example.com`
- Password: `password`
- Role: `admin`

9. **Build assets**
```bash
npm run build
```

10. **Start the development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Project Structure

### Models
- `User` - User accounts with roles
- `Post` - Blog posts
- `Comment` - Post comments

### Controllers
- `PostController` - Post management
- `CommentController` - Comment management
- `Admin\UserController` - Admin user management

### Middleware
- `IsAdmin` - Protects admin routes

### Policies
- `PostPolicy` - Authorization for post actions
- `CommentPolicy` - Authorization for comment actions

### Form Requests
- `StorePostRequest` - Post validation
- `StoreCommentRequest` - Comment validation

## Usage

### For Regular Users
- Browse and read posts
- Create new posts
- Edit and delete own posts
- Add comments to posts
- Delete own comments

### For Administrators
- All user permissions
- Edit/delete any post
- Delete any comment
- Access admin panel
- Manage users (create, edit, delete)
- Change user roles
- View user statistics

## Routes

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

### Admin Routes
- `GET /admin/users` - List users
- `GET /admin/users/create` - Create user form
- `POST /admin/users` - Store new user
- `GET /admin/users/{user}/edit` - Edit user form
- `PUT /admin/users/{user}` - Update user
- `DELETE /admin/users/{user}` - Delete user

## Security Features

- CSRF protection on all forms
- Password hashing
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade escaping)
- Authorization policies
- Role-based access control
- Secure password requirements

## Database Schema

### Users Table
- `id` - Primary key
- `name` - User name
- `email` - Unique email
- `password` - Hashed password
- `role` - User role (user/admin)
- `timestamps`

### Posts Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `title` - Post title
- `body` - Post content
- `timestamps`

### Comments Table
- `id` - Primary key
- `post_id` - Foreign key to posts
- `user_id` - Foreign key to users
- `content` - Comment text
- `timestamps`

## Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Future Enhancements

- [ ] Post categories and tags
- [ ] Search functionality
- [ ] Image uploads for posts
- [ ] Email notifications
- [ ] Comment editing
- [ ] Soft deletes
- [ ] API endpoints
- [ ] Post drafts
- [ ] Social media sharing
- [ ] User profiles

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
