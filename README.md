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

## Requirements

-   PHP 8.0 or higher
-   Composer
-   MySQL (or any other database)
-   Node.js (for frontend build, optional)
-   Docker (optional)

## Installation

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
