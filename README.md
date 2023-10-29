# Mini E-commerce Project 

# Project Structure

1. **User Management**
    - User Registration & Login
    - Profile Management
    - Password Recovery

2. **Product Management**
    - Add/Edit/Delete Products
    - Product Categories & Sub-categories
    - Product Images & Descriptions
    - Price & Discounts
    - Product Reviews & Ratings

3. **Search & Filtering**
    - Product Search
    - Filter Products by
        - Categories
        - Price Range
        - Ratings
        - Brands

4. **Cart & Wishlist**
    - Add/Remove Items to/from Cart
    - Update Quantity in Cart
    - Save Products for Later (Wishlist)

5. **Order Management**
    - Order Placement
    - Order History & Details
    - Order Tracking & Status Updates

6. **Checkout Process**
    - Shipping Address Management
    - Selection of Payment Methods
    - Order Review & Confirmation
    - Invoice Generation

7. **Payment Integration**
    - Multiple Payment Options (Credit Card, PayPal, etc.)
    - Secure Payment Gateway Integration
    - Transaction History

8. **Notifications & Alerts**
    - Order Confirmation
    - Shipping Updates
    - Promotional Alerts

9. **Customer Support & Feedback**
    - FAQs
    - Live Chat Support
    - Return & Refund Policies

---

This structure covers most of the essential features for a small yet robust e-commerce platform. Depending on the specific requirements, some additional features might be added or existing ones further customized.


# Project Database

1. **User Management** `laravel breeze authentication system`
    - Users
    - Profiles
    - PasswordRecoveries

2. **Product Management**
    - Products
        ```php
        class CreateProductsTable extends Migration
        {
            public function up()
            {
                Schema::create('products', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('sub_category_id')->constrained()->index()->onDelete('cascade');
                    $table->string('name')->index();
                    $table->string('sku')->unique()->nullable();  // Unique Stock Keeping Unit
                    $table->text('description');
                    $table->decimal('price', 8, 2);
                    $table->integer('quantity');  // Quantity in stock
                    $table->foreignId('created_by')->constrained('users')->nullable()->onDelete('set null');  // Who created this product?
                    $table->foreignId('updated_by')->constrained('users')->nullable()->onDelete('set null');  // Who last updated this product?
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('products');
            }
        }
        ```
    - Categories
        ```php
        class CreateCategoriesTable extends Migration
        {
            public function up()
            {
                Schema::create('categories', function (Blueprint $table) {
                    $table->id();
                    $table->string('name')->unique();
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('categories');
            }
        }
        ```
    - SubCategories
        ```php
         class CreateSubCategoriesTable extends Migration
        {
            public function up()
            {
                Schema::create('sub_categories', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('category_id')->constrained()->index()->onDelete('cascade');   // Index foreign keys
                    $table->string('name')->index();  // Index sub-category names for quicker search
                    $table->timestamps();
                });
            }

            // ... rest of the code
        }
        ```
    - ProductImages
        ```php
         class CreateProductImagesTable extends Migration
        {
            public function up()
            {
                Schema::create('product_images', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('product_id')->constrained()->index()->onDelete('cascade'); // Index foreign keys
                    $table->string('image_url');
                    $table->timestamps();
                });
            }

            // ... rest of the code
        }
        ```
    - Reviews
        ```php
         class CreateReviewsTable extends Migration
        {
            public function up()
            {
                Schema::create('reviews', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('product_id')->constrained()->index()->onDelete('cascade'); // Index foreign keys
                    $table->foreignId('user_id')->constrained()->index()->onDelete('cascade'); // Index foreign keys
                    $table->text('review_text');
                    $table->timestamps();
                });
            }

            // ... rest of the code
        }
        ```
    - Ratings
        ```php
         class CreateRatingsTable extends Migration
        {
            public function up()
            {
                Schema::create('ratings', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('product_id')->constrained()->index()->onDelete('cascade');   // Index foreign keys
                    $table->foreignId('user_id')->constrained()->index()->onDelete('cascade');   // Index foreign keys
                    $table->tinyInteger('rating_value');  // Use tinyInteger for small range values
                    $table->timestamps();
                });
            }

            // ... rest of the code
        }

        ```

3. **Search & Filtering**
    - Brands
    - (The other filtering functionalities like Product Search, Filter Products by Categories, Price Range, and Ratings can be achieved through queries without needing separate tables.)

4. **Cart & Wishlist**
    - Carts
    - CartItems
    - Wishlists
    - WishlistItems

5. **Order Management**
    - Orders
    - OrderItems
    - OrderHistory
    - OrderTracking

6. **Checkout Process**
    - ShippingAddresses
    - BillingAddresses
    - PaymentMethods
    - OrderReviews
    - Invoices

7. **Payment Integration**
    - PaymentOptions
    - PaymentTransactions

8. **Notifications & Alerts**
    - Notifications

9. **Customer Support & Feedback**
    - FAQs
    - Chats
    - Returns
    - RefundPolicies

