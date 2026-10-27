# TaskFlow

A full-stack task management application built with Laravel, Blade, Tailwind CSS, JavaScript, SQLite, and Laravel Sanctum.

TaskFlow was created as a portfolio project to demonstrate practical skills in authentication, CRUD operations, authorization, database design, REST APIs, responsive UI, and Laravel application architecture.

## Features

- User registration and authentication
- User-specific tasks
- Create, edit, and delete tasks
- Mark tasks as completed or pending
- Task priorities: Low, Medium, High
- Optional due dates
- Search tasks by title or description
- Filter by status
- Filter by priority
- Responsive dashboard
- Profile management
- Authorization with Laravel Policies
- REST API with Laravel Sanctum
- SQLite database for simple local development
- Tailwind CSS interface
- Vite asset compilation

## Tech Stack

- **Backend:** Laravel / PHP
- **Frontend:** Blade, Tailwind CSS, JavaScript
- **Database:** SQLite
- **Authentication:** Laravel Breeze
- **API Authentication:** Laravel Sanctum
- **Build Tool:** Vite
- **Package Management:** Composer / npm

## Requirements

Before running the project, make sure you have installed:

- PHP 8.2+
- Composer
- Node.js and npm
- Git

You can verify your installations with:

```bash
php -v
composer -V
node -v
npm -v
git --version
```

## Run TaskFlow Locally

### 1. Clone the repository

```bash
git clone https://github.com/RamsesJM/task-manager.git
```

Enter the project directory:

```bash
cd task-manager
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create the environment file

Windows:

```powershell
copy .env.example .env
```

macOS/Linux:

```bash
cp .env.example .env
```

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Create the SQLite database

Windows PowerShell:

```powershell
New-Item database/database.sqlite -ItemType File
```

macOS/Linux:

```bash
touch database/database.sqlite
```

Make sure the `.env` database configuration uses SQLite:

```env
DB_CONNECTION=sqlite
```

### 7. Run the database migrations

```bash
php artisan migrate
```

This creates the required tables for users, tasks, sessions, cache, jobs, and API tokens.

### 8. Build the frontend assets

```bash
npm run build
```

### 9. Start the Laravel development server

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Testing the Application

After opening TaskFlow, create an account using the registration page.

Then test the main functionality:

1. Register a new account.
2. Log in.
3. Create a task.
4. Set its priority.
5. Add an optional due date.
6. Mark the task as completed.
7. Reopen the task.
8. Edit the task.
9. Search for the task.
10. Filter tasks by status and priority.
11. Delete the task.
12. Open the profile section.

## Security and Authorization

TaskFlow uses Laravel authentication and authorization features.

Each task belongs to a specific user. Users can only access and modify their own tasks.

Task authorization is handled through Laravel Policies rather than relying only on frontend restrictions.

The application also includes protected API endpoints using Laravel Sanctum.

## API

TaskFlow includes a REST API.

Available API functionality includes:

- User login
- Authenticated user information
- Logout
- Task CRUD operations

Protected API endpoints require a valid Sanctum authentication token.

The API routes are located in:

```text
routes/api.php
```

## Project Structure

Important parts of the project include:

```text
app/
├── Http/
│   └── Controllers/
├── Models/
│   ├── Task.php
│   └── User.php
└── Policies/
    └── TaskPolicy.php

database/
├── migrations/
└── database.sqlite

resources/
├── css/
├── js/
└── views/

routes/
├── api.php
├── web.php
└── auth.php
```

## Database Design

The main entities are:

### Users

Stores registered application users.

### Tasks

Each task contains:

- Title
- Description
- Completion status
- Priority
- Due date
- User relationship
- Created and updated timestamps

Tasks are associated with users through a foreign key, ensuring that each user's data remains isolated.

## Development

To run the application during development:

Terminal 1:

```bash
php artisan serve
```

Terminal 2:

```bash
npm run dev
```

Then open:

```text
http://127.0.0.1:8000
```

For a production-style frontend build:

```bash
npm run build
```

## Why I Built This Project

TaskFlow was developed as a practical demonstration of modern Laravel development.

The project focuses on building functionality rather than only creating a visual interface. It demonstrates authentication, authorization, relational database design, CRUD operations, API development, validation, filtering, responsive UI, and frontend asset management.

## Author

**Ramses Jimenez**

GitHub:

https://github.com/RamsesJM