# 🛒 E-commerce Platform with Delivery Management System

A comprehensive, full-stack e-commerce platform with integrated delivery management system built with Laravel and Filament. This project features a complete point-of-sale (POS) system, admin dashboard, and RESTful APIs for mobile and web applications, supporting multi-language functionality (Arabic/English).

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![Filament](https://img.shields.io/badge/Filament-3.x-orange.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## 🌟 Features

### 🏪 Core E-commerce Features

-   **Product Management**: Complete product catalog with categories, brands, and attributes
-   **Inventory Management**: Stock tracking and product status management
-   **Shopping Cart & Wishlist**: Persistent cart and wishlist functionality
-   **Order Management**: Comprehensive order processing and tracking system
-   **User Management**: Multi-role user system (Admin, Customer, Deliveryman)
-   **Review & Rating System**: Customer feedback and product ratings

### 💳 Payment & Pricing

-   **Flexible Pricing**: Support for regular and sale prices
-   **Coupon System**: Discount codes with percentage or fixed amount discounts
-   **Multiple Payment Methods**: Integrated payment gateway support
-   **Delivery Fee Calculation**: Dynamic delivery fee based on location

### 🚚 Delivery Management

-   **Delivery System**: Complete delivery management with driver assignment
-   **Geographic Management**: Cities, areas, and delivery zones
-   **Distance Calculation**: Google Maps integration for distance-based delivery fees
-   **Real-time Tracking**: Order status updates and notifications

### 📱 POS System

-   **Point of Sale Interface**: Built-in POS system for in-store sales
-   **Product Search & Filter**: Quick product lookup and category filtering
-   **Customer Management**: Customer selection and address management
-   **Real-time Cart**: Dynamic cart with instant total calculations
-   **Order Processing**: Direct order creation from POS interface

### 🎛️ Admin Dashboard (Filament)

-   **Modern UI**: Beautiful, responsive Filament admin interface
-   **Dashboard Analytics**: Sales statistics and performance metrics
-   **Resource Management**: Complete CRUD operations for all entities
-   **User Role Management**: Admin, customer, and deliveryman management
-   **Settings Configuration**: System-wide settings and configurations
-   **Notification System**: Push notifications with Firebase integration

### 🌐 Multi-language Support

-   **Bilingual Support**: Arabic and English language support
-   **RTL Layout**: Right-to-left layout support for Arabic
-   **Localized Content**: All content and UI elements are translatable

### 📡 API Integration

-   **RESTful APIs**: Complete API set for mobile and web applications
-   **JWT Authentication**: Secure authentication system
-   **API Documentation**: Well-structured API endpoints
-   **Mobile App Support**: Ready for iOS and Android integration

## 🏗️ Technical Architecture

### Backend Technologies

-   **Framework**: Laravel 12.x
-   **Admin Panel**: Filament 3.x
-   **Database**: MySQL
-   **Authentication**: JWT + Laravel Sanctum
-   **File Storage**: Laravel Storage with configurable drivers
-   **Queue System**: Laravel Queue for background processing

### Frontend Technologies

-   **CSS Framework**: Tailwind CSS 4.x
-   **Build Tool**: Vite 6.x
-   **JavaScript**: Modern ES6+ with Axios for HTTP requests
-   **UI Components**: Filament's Blade components

### Third-party Integrations

-   **Maps**: Google Maps API for location services
-   **Push Notifications**: Firebase Cloud Messaging (FCM)
-   **Payment Gateway**: Paymob integration
-   **Image Processing**: Laravel's built-in image handling

## 📁 Project Structure

```
├── app/
│   ├── Enums/                          # System enumerations
│   │   ├── DiscountType.php           # Coupon discount types (percentage/fixed)
│   │   ├── OrderStatus.php            # Order status values
│   │   ├── ProductStatus.php          # Product status values
│   │   └── UserType.php               # User role definitions
│   ├── Filament/                      # Filament admin panel
│   │   ├── Pages/                     # Custom admin pages
│   │   ├── Resources/                 # CRUD resource management
│   │   └── Widgets/                   # Dashboard widgets
│   ├── Helpers/                       # Utility helper classes
│   │   ├── CategoryHelpers.php        # Category-related utilities
│   │   ├── DestanceHelpers.php        # Distance calculation utilities
│   │   ├── HandlesPasswordLogin.php   # Authentication helpers
│   │   ├── ImageHelpers.php           # Image processing utilities
│   │   ├── PriceHelpers.php           # Price calculation helpers
│   │   └── SettingHelpers.php         # Application settings helpers
│   ├── Http/
│   │   ├── Controllers/               # API and web controllers
│   │   ├── Middleware/                # Custom middleware
│   │   └── Requests/                  # Form request validation classes
│   ├── Models/                        # Eloquent models
│   │   ├── Address.php                # User addresses
│   │   ├── Area.php                   # Delivery areas
│   │   ├── Attribute.php              # Product attributes (Color, Size, etc.)
│   │   ├── AttributeValue.php         # Attribute values
│   │   ├── Banner.php                 # Home page banners
│   │   ├── Brand.php                  # Product brands
│   │   ├── Cart.php                   # Shopping cart items
│   │   ├── CartProductAttributeValue.php # Cart item attributes
│   │   ├── Category.php               # Product categories
│   │   ├── City.php                   # Cities for delivery
│   │   ├── Config.php                 # Application configurations
│   │   ├── Coupon.php                 # Discount coupons
│   │   ├── DeliveryFee.php            # Delivery fee calculations
│   │   ├── Notification.php           # Push notifications
│   │   ├── Order.php                  # Customer orders
│   │   ├── OrderDetail.php            # Order line items
│   │   ├── OrderDetailAttributeValue.php # Order item attributes
│   │   ├── PaymobPayment.php          # Payment gateway integration
│   │   ├── Product.php                # Products catalog
│   │   ├── ProductAttributeValue.php  # Product attribute values
│   │   ├── ProductImage.php           # Product image gallery
│   │   ├── Review.php                 # Product reviews and ratings
│   │   ├── Setting.php                # System settings
│   │   ├── User.php                   # User accounts
│   │   ├── UserCoupons.php            # User coupon usage tracking
│   │   └── Wishlist.php               # User wishlist items
│   ├── Providers/                     # Service providers
│   │   ├── AppServiceProvider.php     # Main application service provider
│   │   ├── LivewireServiceProvider.php # Livewire configuration
│   │   └── Filament/                  # Filament-specific providers
│   ├── Repository/                    # Repository pattern implementation
│   │   ├── Contracts/                 # Repository interfaces
│   │   └── Eloquent/                  # Eloquent repository implementations
│   ├── Services/                      # Business logic services
│   │   ├── Contracts/                 # Service interfaces
│   │   └── Implementations/           # Service implementations
│   └── Strategies/                    # Strategy pattern implementations
│       ├── Contracts/                 # Strategy interfaces
│       └── Implementations/           # Strategy implementations (Payment, Delivery)
├── config/                            # Configuration files
│   ├── app.php                        # Application configuration
│   ├── auth.php                       # Authentication configuration
│   ├── database.php                   # Database configuration
│   ├── filament-google-maps.php       # Google Maps integration
│   ├── jwt.php                        # JWT authentication settings
│   └── services.php                   # Third-party service configurations
├── database/
│   ├── migrations/                    # Database schema migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_05_06_174028_create_banners_table.php
│   │   ├── 2025_05_07_103326_create_configs_table.php
│   │   └── ... (additional migration files)
│   ├── seeders/                       # Database seeders
│   │   ├── ConfigTableSeeder.php      # Configuration data seeder
│   │   └── ... (additional seeders)
│   └── factories/                     # Model factories for testing
├── resources/
│   ├── lang/                          # Multi-language support
│   │   ├── ar/                        # Arabic language files
│   │   ├── en/                        # English language files
│   │   └── vendor/                    # Third-party package translations
│   ├── views/                         # Blade templates
│   ├── css/                           # CSS assets
│   └── js/                            # JavaScript assets
├── routes/
│   ├── api.php                        # API routes for mobile/web apps
│   ├── web.php                        # Web routes for admin panel
│   └── console.php                    # Artisan console commands
├── storage/
│   ├── app/                           # Application file storage
│   ├── firebase/                      # Firebase service account files
│   ├── framework/                     # Framework cache files
│   └── logs/                          # Application logs
├── public/                            # Publicly accessible files
│   ├── css/                           # Compiled CSS files
│   ├── js/                            # Compiled JavaScript files
│   ├── vendor/                        # Third-party assets
│   └── firebase-messaging-sw.js       # Firebase service worker
├── tests/                             # Automated tests
│   ├── Feature/                       # Feature tests
│   └── Unit/                          # Unit tests
├── composer.json                      # PHP dependencies
├── package.json                       # Node.js dependencies
├── vite.config.js                     # Vite build configuration
└── artisan                            # Laravel command-line tool
```

### Key Architecture Highlights:

**🏗️ Repository Pattern**: Clean separation between data access and business logic  
**🎯 Service Layer**: Centralized business logic in dedicated service classes  
**📋 Strategy Pattern**: Flexible payment and delivery strategy implementations  
**🔧 Helper Classes**: Reusable utility functions for common operations  
**🎨 Filament Integration**: Modern admin panel with custom pages and widgets  
**🌐 Multi-language**: Complete Arabic/English localization support  
**📱 API-First**: RESTful API design for mobile and web applications

## 🚀 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   MySQL/MariaDB
-   Google Maps API Key
-   Firebase Project (for push notifications)

### Installation Steps

1. **Clone the repository**

```bash
git clone <repository-url>
cd Ecommerce-With-Delivery
```

2. **Install PHP dependencies**

```bash
composer install
```

3. **Install Node.js dependencies**

```bash
npm install
```

4. **Environment Setup**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure your `.env` file**

```env
APP_NAME="E-commerce Platform"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_delivery
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Google Maps API
GOOGLE_MAPS_API_KEY=your_google_maps_api_key

# Firebase Configuration
FIREBASE_PROJECT_ID=your_firebase_project_id
FIREBASE_PRIVATE_KEY_ID=your_firebase_private_key_id
FIREBASE_PRIVATE_KEY="your_firebase_private_key"
FIREBASE_CLIENT_EMAIL=your_firebase_client_email
FIREBASE_CLIENT_ID=your_firebase_client_id

# JWT Secret
JWT_SECRET=your_jwt_secret

# Payment Gateway (Paymob)
PAYMOB_API_KEY=your_paymob_api_key
PAYMOB_MERCHANT_ID=your_paymob_merchant_id
PAYMOB_INTEGRATION_ID=your_paymob_integration_id
PAYMOB_HMAC_SECRET=your_paymob_hmac_secret
PAYMOB_WALLET_INTEGRATION_ID=your_paymob_wallet_integration_id
PAYMOB_IFRAME_ID=your_paymob_iframe_id
```

6. **Database Setup**

```bash
php artisan migrate
php artisan db:seed
```

7. **Storage Link**

```bash
php artisan storage:link
```

8. **Build Assets**

```bash
npm run build
```

9. **Start the Development Server**

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 🎯 Usage

### Admin Dashboard

Access the admin dashboard at `/admin` with your admin credentials.

**Default Features:**

-   **Dashboard**: View sales analytics and system statistics
-   **Store Management**: Manage products, categories, brands, and attributes
-   **Order Management**: Process and track orders
-   **User Management**: Manage customers, admins, and delivery personnel
-   **POS System**: Use the built-in point-of-sale system
-   **Settings**: Configure delivery settings, banners, and system preferences

### API Endpoints

#### Authentication

-   `POST /api/auth/login` - User login
-   `POST /api/auth/register` - User registration
-   `GET /api/auth/profile` - Get user profile
-   `POST /api/auth/profile/update` - Update user profile

#### Products & Categories

-   `GET /api/products` - Get all products
-   `GET /api/products/{id}` - Get product details
-   `GET /api/categories` - Get all categories
-   `GET /api/products/category/{categoryId}` - Get products by category

#### Shopping Cart

-   `GET /api/carts` - Get user cart
-   `POST /api/carts` - Add item to cart
-   `PUT /api/carts/{id}` - Update cart item
-   `DELETE /api/carts/{id}` - Remove item from cart

#### Orders

-   `GET /api/orders` - Get user orders
-   `POST /api/orders` - Create new order
-   `GET /api/orders/{id}` - Get order details

#### Wishlist

-   `GET /api/wishlists` - Get user wishlist
-   `POST /api/wishlists` - Add item to wishlist
-   `DELETE /api/wishlists/{id}` - Remove item from wishlist

## ⚙️ Configuration

### Delivery Settings

Configure delivery options in the admin panel:

-   **Delivery Fee Type**: Fixed amount or area-based
-   **Delivery Areas**: Define delivery zones and fees
-   **Distance Calculation**: Google Maps integration for automatic distance calculation

### Payment Configuration

Set up payment gateways in the configuration:

-   Paymob integration for online payments
-   Cash on delivery option
-   Payment callback handling

### Notification Settings

Configure push notifications:

-   Firebase Cloud Messaging setup
-   Notification templates
-   User targeting options

## 🔧 Development

### Running Tests

```bash
php artisan test
```

### Code Style

```bash
composer run-script format
```

### Database Seeding

```bash
php artisan db:seed --class=ConfigTableSeeder
```

## 📚 API Documentation

### Base URL

```
http://localhost:8000/api
```

### Authentication

All API endpoints (except public ones) require authentication using JWT tokens.

**Headers:**

```
Authorization: Bearer {jwt_token}
Accept: application/json
Content-Type: application/json
```

### Response Format

All API responses follow a consistent format:

```json
{
    "status": true,
    "errorNum": null,
    "message": "Success message",
    "data": {
        // Response data
    }
}
```

### Error Handling

Error responses include appropriate HTTP status codes and error messages:

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Error message"
}
```

### Language Support

All endpoints support language switching via query parameter:

-   `?lang=ar` - Arabic language (returns `name_ar` as `name`)
-   `?lang=en` - English language (returns `name_en` as `name`) - Default

Example: `GET /api/products?lang=ar`

### Response Format Details

All API responses use a custom macro with this structure:

```json
{
    "status": true,
    "errorNum": null,
    "message": "Response message",
    "data": {} // Only included when there is data to return
}
```

**Status Values:**

-   `true` - Successful operations (HTTP 200/201)
-   `false` - Failed operations (HTTP 400/401/404/422/500)

**Error Numbers (HTTP Status Codes):**

-   `null` - Success operations (always null for successful responses)
-   `400` - Bad request/business logic errors
-   `401` - Unauthorized access
-   `404` - Resource not found
-   `422` - Validation errors
-   `500` - Internal server errors

**Validation Error Format:**  
When validation fails, the response returns a single error message:

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The email field is required."
}
```

---

## ✅ API Response Format Summary

All API endpoints in this documentation follow the standardized response format:

### Success Responses

```json
{
    "status": true,
    "errorNum": null, // Always null for successful operations
    "message": "Success message",
    "data": {} // Only included when there is data to return
}
```

### Error Responses

```json
{
    "status": false,
    "errorNum": 400, // HTTP status code (400, 401, 404, 422, 500)
    "message": "Error message" // Single error message for all error types
}
```

### Key Changes Made:

-   ✅ **Status field**: Changed from string values to boolean (`true`/`false`)
-   ✅ **Error numbers**: Success responses use `null`, error responses use HTTP status codes (400, 401, 404, 422, 500)
-   ✅ **Single error messages**: No more error arrays, just single error messages
-   ✅ **Localized names**: All entity names are returned based on `?lang=` parameter
-   ✅ **Consistent format**: All endpoints follow the same response structure

---

### 🔑 Authentication Endpoints

### Login

```http
POST /api/auth/login
```

**Request Body:**

```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com",
            "phone": "01234567890",
            "user_type": "user"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
    }
}
```

**Error Responses:**

**Invalid Credentials (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Invalid credentials"
}
```

**Validation Error (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The email field is required."
}
```

**Account Blocked (403):**

```json
{
    "status": false,
    "errorNum": 403,
    "message": "Account is blocked. Please contact support."
}
```

### Register

```http
POST /api/auth/register
```

**Request Body:**

```json
{
    "name": "John Doe",
    "email": "user@example.com",
    "phone": "01234567890",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Success Response (201):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "user@example.com",
            "phone": "01234567890",
            "user_type": "user"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."
    }
}
```

**Error Responses:**

**Validation Error (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The email has already been taken."
}
```

**Server Error (500):**

```json
{
    "status": false,
    "errorNum": 500,
    "message": "Registration failed. Please try again."
}
```

### Get Profile

```http
GET /api/auth/profile
```

**Authorization Required**

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Profile retrieved successfully",
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com",
        "phone": "01234567890",
        "user_type": "user",
        "created_at": "2025-01-01T00:00:00.000000Z"
    }
}
```

**Error Responses:**

**Unauthorized (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Unauthorized"
}
```

**Token Expired (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Token has expired"
}
```

### Update Profile

```http
POST /api/auth/profile/update
```

**Authorization Required**

**Request Body:**

```json
{
    "name": "John Doe Updated",
    "phone": "01234567891"
}
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Profile updated successfully",
    "data": {
        "id": 1,
        "name": "John Doe Updated",
        "email": "user@example.com",
        "phone": "01234567891",
        "user_type": "user"
    }
}
```

**Error Responses:**

**Validation Error (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The phone has already been taken."
}
```

**Unauthorized (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Unauthorized"
}
```

### Delete Profile

```http
POST /api/auth/profile/delete
```

**Authorization Required**

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Profile deleted successfully"
}
```

**Error Responses:**

**Unauthorized (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Unauthorized"
}
```

**Active Orders Error (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Cannot delete profile with active orders"
}
```

## 🏠 Home Endpoints

### Get Banners

```http
GET /api/home/banners
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Banners retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Summer Sale",
            "image": "storage/banners/banner1.jpg",
            "link": "https://example.com/sale"
        }
    ]
}
```

**Error Responses:**

**No Banners Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No banners found"
}
```

**Server Error (500):**

```json
{
    "status": false,
    "errorNum": 500,
    "message": "Failed to retrieve banners"
}
```

### Get Brands

```http
GET /api/home/brands
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Brands retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Brand Name",
            "image": "storage/brands/brand1.jpg"
        }
    ]
}
```

**Note:** The `name` field contains localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**No Brands Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No brands found"
}
```

**Server Error (500):**

```json
{
    "status": false,
    "errorNum": 500,
    "message": "Failed to retrieve brands"
}
```

### Get Popular Categories

```http
GET /api/home/categories
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Popular categories retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Electronics",
            "slug": "electronics",
            "image": "storage/categories/electronics.jpg"
        }
    ]
}
```

**Note:** The `name` field contains localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**No Categories Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No popular categories found"
}
```

### Get Latest Products

```http
GET /api/home/products
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Latest products retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Product Name",
            "price": 100.0,
            "sale_price": 80.0,
            "image": "storage/products/product1.jpg"
        }
    ]
}
```

**Note:** The `name` field contains localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**No Products Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No products found"
}
```

## 🏷️ Category Endpoints

### Get All Categories

```http
GET /api/categories
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Categories retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Electronics",
            "slug": "electronics",
            "image": "storage/categories/electronics.jpg",
            "parent_id": null,
            "children": [
                {
                    "id": 2,
                    "name": "Phones",
                    "slug": "phones",
                    "image": "storage/categories/phones.jpg",
                    "parent_id": 1
                }
            ]
        }
    ]
}
```

**Note:** The `name` field contains localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**No Categories Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No categories found"
}
```

**Server Error (500):**

```json
{
    "status": false,
    "errorNum": 500,
    "message": "Failed to retrieve categories"
}
```

### Get Parent Categories

```http
GET /api/categories/parent
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Parent categories retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Electronics",
            "slug": "electronics",
            "image": "storage/categories/electronics.jpg"
        }
    ]
}
```

**Note:** The `name` field contains localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**No Parent Categories Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No parent categories found"
}
```

### Get Children Categories

```http
GET /api/categories/children/{id}
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Children categories retrieved successfully",
    "data": [
        {
            "id": 2,
            "name": "Phones",
            "slug": "phones",
            "image": "storage/categories/phones.jpg",
            "parent_id": 1
        }
    ]
}
```

**Note:** The `name` field contains localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**Category Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Category not found"
}
```

**No Children Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No children categories found"
}
```

## 🛍️ Product Endpoints

### Get All Products

```http
GET /api/products
```

**Query Parameters:**

-   `page` (optional): Page number for pagination
-   `per_page` (optional): Items per page (default: 15)
-   `search` (optional): Search term
-   `category_id` (optional): Filter by category ID
-   `brand_id` (optional): Filter by brand ID
-   `min_price` (optional): Minimum price filter
-   `max_price` (optional): Maximum price filter

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Products retrieved successfully",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Product Name",
                "slug": "product-name",
                "description": "Product description",
                "price": 100.0,
                "sale_price": 80.0,
                "sku": "PRD001",
                "stock": 50,
                "status": "active",
                "images": [
                    {
                        "id": 1,
                        "image": "storage/products/product1.jpg"
                    }
                ],
                "category": {
                    "id": 1,
                    "name": "Electronics"
                },
                "brand": {
                    "id": 1,
                    "name": "Brand Name"
                },
                "attributes": [
                    {
                        "attribute": {
                            "id": 1,
                            "name": "Color"
                        },
                        "value": "Red"
                    }
                ]
            }
        ],
        "per_page": 15,
        "total": 100
    }
}
```

**Note:** The `name` and `description` fields contain localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` and `description_en` as `description` (default)
-   `?lang=ar` returns `name_ar` as `name` and `description_ar` as `description`

**Error Responses:**

**No Products Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No products found"
}
```

**Invalid Filter Parameters (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "The min price must be a number."
}
```

### Get Product Details

```http
GET /api/products/{id}
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Product retrieved successfully",
    "data": {
        "id": 1,
        "name": "Product Name",
        "slug": "product-name",
        "description": "Detailed product description",
        "price": 100.0,
        "sale_price": 80.0,
        "sku": "PRD001",
        "stock": 50,
        "status": "active",
        "images": [
            {
                "id": 1,
                "image": "storage/products/product1.jpg"
            },
            {
                "id": 2,
                "image": "storage/products/product1_2.jpg"
            }
        ],
        "category": {
            "id": 1,
            "name": "Electronics"
        },
        "brand": {
            "id": 1,
            "name": "Brand Name"
        },
        "attributes": [
            {
                "attribute": {
                    "id": 1,
                    "name": "Color"
                },
                "value": "Red"
            }
        ],
        "reviews": [
            {
                "id": 1,
                "rating": 5,
                "comment": "Excellent product!",
                "user": {
                    "name": "John Doe"
                }
            }
        ],
        "average_rating": 4.5,
        "reviews_count": 10
    }
}
```

**Note:** The `name` and `description` fields contain localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` and `description_en` as `description` (default)
-   `?lang=ar` returns `name_ar` as `name` and `description_ar` as `description`

**Error Responses:**

**Product Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Product not found"
}
```

**Product Inactive (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Product is not available"
}
```

### Get Products by Category

```http
GET /api/products/category/{categoryId}
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Category products retrieved successfully",
    "data": {
        "category": {
            "id": 1,
            "name": "Electronics"
        },
        "products": {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "name": "Product Name",
                    "price": 100.0,
                    "sale_price": 80.0,
                    "image": "storage/products/product1.jpg"
                }
            ],
            "per_page": 15,
            "total": 25
        }
    }
}
```

**Note:** The `name` fields contain localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**Category Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Category not found"
}
```

**No Products in Category (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "No products found in this category"
}
```

## 🛒 Cart Endpoints

### Get User Cart

```http
GET /api/carts
```

**Authorization Required**

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Cart retrieved successfully",
    "data": [
        {
            "id": 1,
            "quantity": 2,
            "product": {
                "id": 1,
                "name": "Product Name",
                "price": 100.0,
                "sale_price": 80.0,
                "images": [
                    {
                        "image": "storage/products/product1.jpg"
                    }
                ]
            },
            "attributes": [
                {
                    "attribute_value": {
                        "value": "Red",
                        "attribute": {
                            "name": "Color"
                        }
                    }
                }
            ]
        }
    ]
}
```

**Note:** The `name` fields contain localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**Empty Cart (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Cart is empty"
}
```

**Unauthorized (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Unauthorized"
}
```

### Add Item to Cart

```http
POST /api/carts
```

**Authorization Required**

**Request Body:**

```json
{
    "product_id": 1,
    "quantity": 2,
    "attribute_values": [1, 2] // Optional: array of attribute value IDs
}
```

**Success Response (201):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Item added to cart successfully",
    "data": {
        "id": 1,
        "quantity": 2,
        "product": {
            "id": 1,
            "name": "Product Name",
            "price": 100.0,
            "sale_price": 80.0
        },
        "attributes": [
            {
                "attribute_value": {
                    "value": "Red",
                    "attribute": {
                        "name": "Color"
                    }
                }
            }
        ]
    }
}
```

**Note:** The `name` fields contain localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**Product Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Product not found"
}
```

**Insufficient Stock (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Insufficient stock. Available: 5"
}
```

**Validation Error (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The product id field is required."
}
```

**Product Already in Cart (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Product already exists in cart. Use update instead."
}
```

### Update Cart Item

```http
PUT /api/carts/{id}
```

**Authorization Required**

**Request Body:**

```json
{
    "quantity": 3
}
```

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Cart item updated successfully",
    "data": {
        "id": 1,
        "quantity": 3,
        "product": {
            "id": 1,
            "name": "Product Name",
            "price": 100.0,
            "sale_price": 80.0
        }
    }
}
```

**Note:** The `name` fields contain localized content based on the `lang` parameter:

-   `?lang=en` returns `name_en` as `name` (default)
-   `?lang=ar` returns `name_ar` as `name`

**Error Responses:**

**Cart Item Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Cart item not found"
}
```

**Insufficient Stock (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Insufficient stock. Available: 2"
}
```

**Validation Error (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The quantity must be at least 1."
}
```

### Remove Cart Item

```http
DELETE /api/carts/{id}
```

**Authorization Required**

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Item removed from cart successfully"
}
```

**Error Responses:**

**Cart Item Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Cart item not found"
}
```

**Unauthorized (401):**

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Unauthorized to delete this item"
}
```

### Get Delivery Fee

```http
GET /api/cart/delivery-fee?address_id=1
```

**Authorization Required**

**Success Response (200):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Delivery fee calculated successfully",
    "data": {
        "delivery_fee": 25.0,
        "address": {
            "id": 1,
            "street": "123 Main Street",
            "city": {
                "name": "Cairo"
            },
            "area": {
                "name": "Maadi"
            }
        },
        "distance": "15.5 km",
        "estimated_time": "30 minutes"
    }
}
```

**Error Responses:**

**Address Not Found (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Address not found"
}
```

**Delivery Not Available (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Delivery not available to this area"
}
```

**Missing Address Parameter (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The address id field is required."
}
```

## 📍 Address Endpoints

### Get User Addresses

```http
GET /api/addresses
```

**Authorization Required**

**Response:**

```json
{
    "status": true,
    "errorNum": null,
    "data": [
        {
            "id": 1,
            "street": "123 Main Street",
            "building": "Building A",
            "floor": "3rd Floor",
            "apartment": "Apt 301",
            "landmark": "Near the mall",
            "is_default": true,
            "latitude": 30.0444,
            "longitude": 31.2357,
            "city": {
                "id": 1,
                "name": "Cairo"
            },
            "area": {
                "id": 1,
                "name": "Maadi"
            }
        }
    ]
}
```

### Add New Address

```http
POST /api/addresses
```

**Authorization Required**

**Request Body:**

```json
{
    "street": "123 Main Street",
    "building": "Building A",
    "floor": "3rd Floor",
    "apartment": "Apt 301",
    "landmark": "Near the mall",
    "city_id": 1,
    "area_id": 1,
    "latitude": 30.0444,
    "longitude": 31.2357,
    "is_default": true
}
```

### Update Address

```http
PUT /api/addresses/{id}
```

**Authorization Required**

### Delete Address

```http
DELETE /api/addresses/{id}
```

**Authorization Required**

## ❤️ Wishlist Endpoints

### Get User Wishlist

```http
GET /api/wishlists
```

**Authorization Required**

### Add to Wishlist

```http
POST /api/wishlists
```

**Authorization Required**

**Request Body:**

```json
{
    "product_id": 1
}
```

### Remove from Wishlist

```http
DELETE /api/wishlists/{id}
```

**Authorization Required**

## 🎫 Coupon Endpoints

### Validate Coupon

```http
GET /api/coupons/{code}
```

**Authorization Required**

**Response:**

```json
{
    "status": true,
    "errorNum": null,
    "data": {
        "id": 1,
        "code": "SAVE20",
        "discount_type": "percentage",
        "discount_value": 20.0,
        "expiry_date": "2025-12-31",
        "usage_limit": 100,
        "used_count": 25
    }
}
```

## 📦 Order Endpoints

### Get User Orders

```http
GET /api/orders
```

**Authorization Required**

**Response:**

```json
{
    "status": true,
    "errorNum": null,
    "data": [
        {
            "id": 1,
            "order_number": "ORD-2025-001",
            "status": "pending",
            "subtotal": 200.0,
            "delivery_fee": 25.0,
            "discount": 20.0,
            "total": 205.0,
            "created_at": "2025-01-01T00:00:00.000000Z",
            "address": {
                "street": "123 Main Street",
                "city": {
                    "name": "Cairo"
                }
            },
            "items": [
                {
                    "id": 1,
                    "quantity": 2,
                    "price": 100.0,
                    "product": {
                        "name": "Product Name"
                    }
                }
            ]
        }
    ]
}
```

### Create Order

```http
POST /api/orders
```

**Authorization Required**

**Request Body:**

```json
{
    "address_id": 1,
    "payment_method": "cash_on_delivery", // or "online"
    "coupon_code": "SAVE20", // optional
    "notes": "Please call before delivery" // optional
}
```

**Success Response (201):**

```json
{
    "status": true,
    "errorNum": null,
    "message": "Order created successfully",
    "data": {
        "id": 1,
        "order_number": "ORD-2025-001",
        "status": "pending",
        "subtotal": 200.0,
        "delivery_fee": 25.0,
        "discount": 20.0,
        "total": 205.0,
        "payment_method": "cash_on_delivery",
        "notes": "Please call before delivery",
        "created_at": "2025-01-01T00:00:00.000000Z",
        "address": {
            "street": "123 Main Street",
            "city": {
                "name": "Cairo"
            }
        },
        "items": [
            {
                "id": 1,
                "quantity": 2,
                "price": 100.0,
                "product": {
                    "name": "Product Name"
                }
            }
        ]
    }
}
```

**Error Responses:**

**Empty Cart (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Cart is empty. Cannot create order."
}
```

**Invalid Address (404):**

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Address not found or doesn't belong to user"
}
```

**Invalid Coupon (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Invalid or expired coupon code"
}
```

**Insufficient Stock (400):**

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Insufficient stock for some items",
    "data": {
        "out_of_stock_items": [
            {
                "product": "Product Name",
                "requested": 5,
                "available": 2
            }
        ]
    }
}
```

**Validation Error (422):**

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The address id field is required."
}
```

### Get Order Details

```http
GET /api/orders/{id}
```

**Authorization Required**

## 💳 Payment Endpoints

### Payment Callback

```http
POST /api/payment/callback
```

**Request Body:**

```json
{
    "order_id": 1,
    "transaction_id": "TXN123456",
    "status": "success",
    "amount": 205.0
}
```

## 🔔 Notification Endpoints

### Get Notifications

```http
GET /api/notifications
```

**Response:**

```json
{
    "status": true,
    "errorNum": null,
    "data": [
        {
            "id": 1,
            "title": "Order Confirmed",
            "body": "Your order #ORD-2025-001 has been confirmed",
            "type": "order",
            "created_at": "2025-01-01T00:00:00.000000Z"
        }
    ]
}
```

## 🚚 Deliveryman Endpoints

### Get Deliveryman Orders

```http
GET /api/deliveryman/orders
```

**Authorization Required (Deliveryman Role)**

### Update Order Status

```http
POST /api/deliveryman/orders/status/{id}
```

**Authorization Required (Deliveryman Role)**

**Request Body:**

```json
{
    "status": "picked_up" // or "delivered", "cancelled"
}
```

## 📱 Admin Endpoints

### Save FCM Token (Admin)

```http
POST /api/admin/save-token
```

**Authorization Required (Admin Role)**

**Request Body:**

```json
{
    "fcm_token": "firebase_token_here"
}
```

## ⚙️ Configuration Endpoints

### Get App Configuration

```http
GET /api/config
```

**Response:**

```json
{
    "status": true,
    "errorNum": null,
    "data": {
        "android_app_version": "1.0.0",
        "ios_app_version": "1.0.0",
        "android_app_url": "https://play.google.com/store/apps/details?id=com.example.app",
        "ios_app_url": "https://apps.apple.com/app/id123456789",
        "terms_and_conditions": "<p>Terms and conditions content...</p>",
        "privacy_policy": "<p>Privacy policy content...</p>",
        "refund_policy": "<p>Refund policy content...</p>"
    }
}
```

## 📊 Status Codes & Response Types

### HTTP Status Codes

| Code | Description           | Usage                                         |
| ---- | --------------------- | --------------------------------------------- |
| 200  | Success               | Successful GET, PUT, DELETE requests          |
| 201  | Created               | Successful POST requests (resource creation)  |
| 400  | Bad Request           | Invalid request data or business logic errors |
| 401  | Unauthorized          | Missing or invalid authentication token       |
| 403  | Forbidden             | Access denied (insufficient permissions)      |
| 404  | Not Found             | Resource not found                            |
| 422  | Validation Error      | Request validation failed                     |
| 429  | Too Many Requests     | Rate limit exceeded                           |
| 500  | Internal Server Error | Server-side errors                            |

### Common Error Response Patterns

#### Authentication Errors

```json
{
    "status": false,
    "errorNum": 401,
    "message": "Unauthorized"
}
```

#### Validation Errors

```json
{
    "status": false,
    "errorNum": 422,
    "message": "The field name is required."
}
```

#### Resource Not Found

```json
{
    "status": false,
    "errorNum": 404,
    "message": "Resource not found"
}
```

#### Business Logic Errors

```json
{
    "status": false,
    "errorNum": 400,
    "message": "Specific business error message"
}
```

#### Server Errors

```json
{
    "status": false,
    "errorNum": 500,
    "message": "Internal server error. Please try again later."
}
```

### Success Response Patterns

#### Data Retrieval

```json
{
    "status": true,
    "errorNum": null,
    "message": "Data retrieved successfully",
    "data": {
        // Response data
    }
}
```

#### Data Creation

```json
{
    "status": true,
    "errorNum": null,
    "message": "Resource created successfully",
    "data": {
        // Created resource data
    }
}
```

#### Data Update

```json
{
    "status": true,
    "errorNum": null,
    "message": "Resource updated successfully",
    "data": {
        // Updated resource data
    }
}
```

#### Data Deletion

```json
{
    "status": true,
    "errorNum": null,
    "message": "Resource deleted successfully"
}
```

#### Paginated Responses

```json
{
    "status": true,
    "errorNum": null,
    "data": {
        "current_page": 1,
        "data": [],
        "first_page_url": "http://localhost:8000/api/endpoint?page=1",
        "from": 1,
        "last_page": 5,
        "last_page_url": "http://localhost:8000/api/endpoint?page=5",
        "next_page_url": "http://localhost:8000/api/endpoint?page=2",
        "path": "http://localhost:8000/api/endpoint",
        "per_page": 15,
        "prev_page_url": null,
        "to": 15,
        "total": 75
    }
}
```

## 🔍 Query Parameters

### Pagination

Most list endpoints support pagination:

-   `page`: Page number (default: 1)
-   `per_page`: Items per page (default: 15, max: 100)

### Filtering

Product endpoints support additional filters:

-   `search`: Search in product names and descriptions
-   `category_id`: Filter by category
-   `brand_id`: Filter by brand
-   `min_price` & `max_price`: Price range filter
-   `status`: Filter by product status

### Language

All endpoints support language switching via header:

```
Accept-Language: ar // for Arabic
Accept-Language: en // for English (default)
```

## 🚀 Deployment

### Production Deployment

1. **Server Requirements**

    - PHP 8.2+
    - MySQL 8.0+
    - Nginx/Apache
    - SSL Certificate

2. **Environment Configuration**

    ```bash
    APP_ENV=production
    APP_DEBUG=false
    ```

3. **Optimize for Production**

    ```bash
    composer install --optimize-autoloader --no-dev
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    npm run build
    ```

4. **File Permissions**
    ```bash
    chmod -R 755 storage bootstrap/cache
    ```

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License.

**Copyright (c) 2025 Abdelrahman Elghonemy**

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

**Author Information:**

-   **GitHub:** [@aldod400](https://github.com/aldod400)
-   **Email:** aldodelghonemy400@gmail.com

## 🙏 Acknowledgments

-   **Laravel Framework** - The web artisans framework
-   **Filament** - Beautiful admin panels for Laravel
-   **Google Maps API** - Location and mapping services
-   **Firebase** - Push notification services
-   **Tailwind CSS** - Utility-first CSS framework

## 📞 Support

For support and questions:

-   **Create an issue** in this GitHub repository
-   **Email:** aldodelghonemy400@gmail.com
-   **GitHub:** [@aldod400](https://github.com/aldod400)

## 👨‍💻 Author

This project was developed by **Abdelrahman Elghonemy** ([@aldod400](https://github.com/aldod400))

-   **Email:** aldodelghonemy400@gmail.com
-   **GitHub:** https://github.com/aldod400
-   **LinkedIn:** Feel free to connect for professional inquiries

## 🎯 Key Features Summary

### Admin Dashboard Features:

-   **📊 Analytics Dashboard**: Real-time sales statistics and charts
-   **🛍️ Product Management**: Full CRUD with image galleries and attributes
-   **📦 Order Management**: Complete order lifecycle management
-   **👥 User Management**: Multi-role user system with permissions
-   **🚚 Delivery Management**: Driver assignment and route optimization
-   **💰 POS System**: Built-in point-of-sale for offline sales
-   **🎫 Coupon System**: Flexible discount management
-   **📱 Push Notifications**: Firebase integration for real-time alerts
-   **🌍 Multi-language**: Arabic/English support with RTL layout
-   **⚙️ Settings**: Comprehensive system configuration

### Mobile/Web API Features:

-   **🔐 JWT Authentication**: Secure token-based authentication
-   **🛒 Shopping Cart**: Persistent cart across sessions
-   **❤️ Wishlist**: Save products for later
-   **📍 Address Management**: Multiple delivery addresses
-   **💳 Payment Integration**: Paymob payment gateway
-   **🔔 Notifications**: Real-time push notifications
-   **📱 Mobile Ready**: Optimized for mobile applications
-   **🌐 Multi-language API**: Language-aware responses

### Technical Highlights:

-   **🏗️ Repository Pattern**: Clean architecture implementation
-   **🔄 Service Layer**: Business logic separation
-   **📋 Strategy Pattern**: Flexible payment and delivery strategies
-   **🎨 Filament Admin**: Modern, beautiful admin interface
-   **🗺️ Google Maps**: Location services integration
-   **🔥 Firebase**: Push notifications and analytics
-   **📦 Queue System**: Background job processing
-   **🔒 Security**: Best practices implementation

---

**Built with ❤️ using Laravel & Filament**

_This project demonstrates a complete e-commerce solution with modern web technologies, suitable for both learning and production use._
