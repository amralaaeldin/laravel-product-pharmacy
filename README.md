# Laravel Product and Pharmacy Management System

This is a Laravel-based application that allows you to manage products and pharmacies. It provides features such as product listings, searching, and managing many-to-many relationships between products and pharmacies. The application also supports file uploads, pagination, and more.

## Features

-   **Product Management**: Create, update, and delete products with fields like title, description, image, price, and quantity.
-   **Pharmacy Management**: Create, update, and delete pharmacies.
-   **Many-to-Many Relationship**: Products can be associated with multiple pharmacies, with price and quantity values stored in a pivot table.
-   **Search Functionality**: Search products by name with live search and filtering.
-   **Pagination**: Pagination for both products and pharmacies, with an option to adjust the number of items per page.
-   **Image Upload**: Ability to upload product images with validation.
-   **RESTful API**: API endpoints for interacting with products and pharmacies.
-   **CLI Command**: A CLI command to list the 5 cheapest pharmacies for a given product.
    For Example:

```bash
php artisan products:search-cheapest 5
```

## Requirements

-   PHP 8.0 or higher
-   Composer
-   MySQL (or any other database)
-   Node.js (for frontend build, optional)
-   Docker (optional)

## Installation

### Without Docker

#### Step 1: Clone the Repository & Install Dependencies

Clone the repository to your local machine:

```bash
git clone https://github.com/amralaaeldin/laravel-product-pharmacy
cd laravel-product-pharmacy
composer install
cp .env.example .env
```

#### Step 2: Define Environment Variables

Open the .env file and configure your environment variables.

#### Step 3: Generate an Application Key & Set Up the App

Run the following command to generate an application key:

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed //optional
php artisan storage:link
```

#### Step 4: Start the Development Server

You can start the development server using the following command:

```bash
php artisan serve
```

### With Docker

#### Step 1: Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/amralaaeldin/laravel-product-pharmacy
cd laravel-product-pharmacy
```

#### Step 2: Build the Docker Image using Docker Compose

Build the Docker image using the following command:

```bash
docker-compose build
```

#### Step 3: Start the Docker Containers

Start the Docker containers using the following command:

```bash
docker-compose up -d
```

#### Step 4: Install Composer Dependencies

Install the Composer dependencies inside the PHP container:

```bash
docker-compose exec app composer install
```

#### Step 5: Generate an Application Key & Set Up the App

Generate an application key using the
following command:

```bash
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed //optional
docker-compose exec app php artisan storage:link
```

#### Step 6: Start the Development Server

You can access the application at `http://localhost:8000/public`.

## Troubleshooting

If you run into issues:

-   Ensure Docker is running if you're using Docker.
-   Check the Laravel logs (storage/logs/laravel.log) for detailed error messages.
-   Make sure you have the correct file permissions if you're running on a local system.
-   Check your .env file for any configuration mistakes (like the wrong database credentials).
