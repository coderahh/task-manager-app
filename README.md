# Task Manager Application

This project is a Task Management application built with Laravel, providing a system for managing tasks with varying priorities. The application supports real-time updates, job queues, and a web interface for user interactions.

## Table of Contents

- [Project Overview](#project-overview)
- [Requirements](#requirements)
- [Setup](#setup)

## Project Overview

  The Task Management Application is designed to allow users to create, manage, and prioritize tasks. The application utilizes Laravel's robust features, including job queues, broadcasting, and real-time updates, to provide a seamless user experience. Tasks can be assigned different priorities, and the application ensures that high-priority tasks are processed efficiently.

## Requirements

  Before setting up the project, ensure you have the following installed:

- PHP (version 7.4 or higher)
- Node.js (version 12 or higher)
- Composer (latest version)
- MySQL or another supported database
- Redis (for queue management and broadcasting)
- Laravel (version 8 or higher)

## Setup

1. Clone the repository:

    ```bash
    git clone https://github.com/coderahh/task-manager-app.git
    cd task-manager-app
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Copy the example environment file and configure your environment variables:

    ```bash
    cp .env.example .env
    ```
4. Generate an application key:

    ```bash
    php artisan key:generate
    ```

5. Configure your .env file with the appropriate database and Redis credentials:

    ```bash
    BROADCAST_DRIVER=redis
    QUEUE_CONNECTION=redis
    ```
5. Run the database migrations and  seeders to populate the database:

    ```bash
    php artisan migrate
    php artisan db:seed
    ```    
5. start the Laravel development server:

    ```bash
    php artisan serve
    ```    

5. Install Laravel Echo Server:

    ```bash
    npm install -g laravel-echo-server
    ```    
5. Install Redis Client for Laravel:

    ```bash
    composer require predis/predis
    ```    
5. Install Laravel Echo and Socket.IO Client:

    ```bash
    npm install --save laravel-echo socket.io-client
    ```    
5. Configure Laravel Echo Serve:

    ```bash
    laravel-echo-server init
    ```    
5. Update Broadcasting Configuration:

    ```bash
    'default' => env('BROADCAST_DRIVER', 'redis'),
    ```    
5. Run the Laravel Echo Server:

    ```bash
    laravel-echo-server start
    ```    
5. Start the Laravel Queue Worker:

    ```bash
    php artisan queue:work
    ```    
