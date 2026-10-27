# TaskFlow

TaskFlow is a full-stack task management application built with Laravel. It allows users to create, organize, update, complete, and delete their own tasks through a simple web interface.

The project was built as a practical full-stack application rather than just a CRUD demonstration. It includes authentication, user-specific data, authorization, filtering, task priorities, due dates, and a REST API.

## Features

- User registration and authentication
- User-specific task management
- Create, edit, and delete tasks
- Mark tasks as completed or reopen them
- Task priorities: Low, Medium, and High
- Optional due dates
- Search tasks by title or description
- Filter tasks by status and priority
- Authorization to prevent users from modifying other users' tasks
- REST API protected with Laravel Sanctum
- Profile management
- Form validation
- SQLite database
- Automated authentication and profile tests

## Why These Technologies?

### Laravel

I chose Laravel because it provides a solid structure for building a full-stack PHP application without having to implement common backend functionality from scratch.

Laravel provides routing, controllers, validation, authentication, database migrations, ORM functionality, middleware, authorization, and testing support in the same framework.

For this project, that made it possible to focus on the application's functionality and architecture instead of manually building basic infrastructure.

### PHP

PHP was used because Laravel is built around it and it remains widely used for server-side web applications.

Using PHP also allowed me to work with Laravel's ecosystem and understand how a modern PHP application is structured beyond simple PHP scripts.

### Blade

I chose Blade instead of introducing a separate frontend framework because TaskFlow does not require a highly interactive single-page application.

Blade works directly with Laravel and makes it straightforward to render server-side views while still allowing JavaScript to be used where needed.

This keeps the application simpler and avoids adding frontend complexity that would not provide much value for this project.

### Tailwind CSS

Tailwind CSS was chosen to build the interface without maintaining a large collection of custom CSS classes and stylesheets.

It also makes it easier to keep spacing, typography, responsive layouts, and component styling consistent throughout the application.

For a project like TaskFlow, Tailwind provides enough flexibility to create a clean interface while keeping the styling close to the markup.

### SQLite

SQLite was selected as the database because TaskFlow is a small self-contained application and does not require a separate database server during development.

It is easy to configure, requires very little setup, and works well for local development and portfolio projects.

The application uses Laravel migrations, so moving to a database such as MySQL or PostgreSQL would not require redesigning the application's database structure.

### Laravel Breeze

Laravel Breeze was used for authentication because authentication is important to TaskFlow but is not the main feature being developed.

Instead of building login, registration, password reset, email verification, and related authentication flows from scratch, Breeze provides a lightweight starting point that integrates naturally with Laravel.

This also keeps the authentication implementation close to Laravel's standard conventions.

### Laravel Sanctum

Sanctum was chosen to provide authentication for the REST API.

The API uses personal access tokens to authenticate requests, while the web application continues to use Laravel's normal session-based authentication.

This allows TaskFlow to expose its task functionality to other clients without replacing the authentication system used by the web application.

### Vite

Vite is used as the frontend build tool because it integrates well with Laravel and provides fast development builds and asset bundling.

It handles the application's CSS and JavaScript assets and works directly with the Laravel development workflow.

## Security and Authorization

TaskFlow separates each user's data using Laravel relationships and authorization.

Tasks are associated with the authenticated user through a `user_id` foreign key.

Web requests use the authenticated user's task relationship when retrieving and creating tasks. This prevents a user from simply requesting another user's task list.

Task authorization is handled through a Laravel Policy. Users can only update or delete tasks that belong to them.

The API applies the same ownership rule before allowing a task to be viewed, updated, or deleted.

Sensitive environment variables such as database configuration and application keys are stored in `.env`, which is excluded from Git through `.gitignore`.

## Application Structure

The project follows Laravel's standard application structure.

```text
app/
├── Http/
│   └── Controllers/
│       ├── Api/
│       │   ├── AuthController.php
│       │   └── TaskController.php
│       └── TaskController.php
├── Models/
│   ├── Task.php
│   └── User.php
└── Policies/
    └── TaskPolicy.php

database/
└── migrations/

resources/
├── css/
├── js/
└── views/
    ├── dashboard.blade.php
    ├── layouts/
    └── tasks/

routes/
├── api.php
├── auth.php
└── web.php

tests/
├── Feature/
└── Unit/
```

## API

TaskFlow also provides a REST API.

### Authentication

```http
POST /api/login
```

Returns a Sanctum personal access token when valid credentials are provided.

### Current User

```http
GET /api/me
```

Requires authentication.

### Tasks

```http
GET    /api/tasks
POST   /api/tasks
GET    /api/tasks/{task}
PUT    /api/tasks/{task}
PATCH  /api/tasks/{task}
DELETE /api/tasks/{task}
```

Protected API endpoints require a valid Sanctum token.

## Installation

### Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- Git

### Clone the repository

```bash
git clone https://github.com/RamsesJM/task-manager.git
cd task-manager
```

### Install PHP dependencies

```bash
composer install
```

### Install frontend dependencies

```bash
npm install
```

### Configure the environment

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### Database

The project uses SQLite.

Create the database file if it does not already exist:

```powershell
New-Item database/database.sqlite -ItemType File
```

Then run the migrations:

```bash
php artisan migrate
```

### Build frontend assets

For development:

```bash
npm run dev
```

For a production build:

```bash
npm run build
```

### Start Laravel

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

## Testing

The project includes Laravel feature tests for authentication, registration, password management, email verification, and profile functionality.

Run the test suite with:

```bash
php artisan test
```

## Development

During development, Laravel's development script can be used to run the application and frontend tooling together:

```bash
composer run dev
```

This starts the Laravel development server, queue worker, and Vite development server.

## Database Design

The main application entities are users and tasks.

A user can have multiple tasks:

```text
User
 └── hasMany Tasks

Task
 └── belongsTo User
```

Each task contains:

- Title
- Description
- Completion status
- Priority
- Due date
- User ownership
- Created and updated timestamps

## Project Goals

The main goal of TaskFlow was to build a complete Laravel application while practicing concepts that are important in real-world web development:

- MVC architecture
- Database migrations
- Eloquent relationships
- Authentication
- Authorization and policies
- REST API development
- Input validation
- Server-side rendering
- Frontend asset management
- Automated testing
- Git version control

The project is intentionally built with a relatively simple architecture so that the codebase remains understandable while still demonstrating the main concepts required for a full-stack web application.

## Author

**Ramses Jimenez**

GitHub: [RamsesJM](https://github.com/RamsesJM)