# Mini E-commerce Project 

## Project Structure

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


## Project Database

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
                    $table->foreignId('category_id')->constrained()->index()->onDelete('cascade');
                    $table->foreignId('sub_category_id')->constrained()->index()->onDelete('cascade');
                    $table->string('name')->index();
                    $table->string('slug')->unique();
                    $table->string('image');
                    $table->string('sku')->unique()->nullable();  // Unique Stock Keeping Unit
                    $table->text('description');
                    $table->decimal('price', 8, 2);
                    $table->integer('quantity');  // Quantity in stock
                    $table->enum('status', ['active', 'inactive']);  // Enum column for status 
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
                    $table->string('slug')->unique();
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
                    $table->string('slug')->unique();
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
                    $table->string('images');
                    $table->timestamps();
                });
            }

            // ... rest of the code
        }
        ```
    - Reviews & Rating
        ```php
        class CreateReviewsAndRatingsTable extends Migration
        {
            public function up()
            {
                Schema::create('reviews_and_ratings', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('product_id')->constrained()->index()->onDelete('cascade');  // Index foreign keys
                    $table->foreignId('user_id')->constrained()->index()->onDelete('cascade');  // Index foreign keys
                    $table->text('review_text')->nullable();  // Nullable as it may not be required always
                    $table->tinyInteger('rating_value')->nullable();  // Nullable as it may not be required always
                    $table->timestamps();
                });
            }

            // ... rest of the code
        }
        ```

3. **Search & Filtering**
    - Brands
        ```php
        class CreateBrandsTable extends Migration
        {
            public function up()
            {
                Schema::create('brands', function (Blueprint $table) {
                    $table->id();
                    $table->string('name')->unique();  // Ensure brand names are unique
                    $table->string('slug')->unique();
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('brands');
            }
        }
        ```
    - (The other filtering functionalities like Product Search, Filter Products by Categories, Price Range, and Ratings can be achieved through queries without needing separate tables.)

4. **Cart & Wishlist**
    - Carts & Wishlist
        ```php
        class CreateItemsTable extends Migration
        {
            public function up()
            {
                Schema::create('items', function (Blueprint $table) {
                    $table->id();
                    $table->enum('type', ['cart', 'wishlist']);
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->foreignId('product_id')->constrained()->onDelete('cascade');
                    $table->integer('quantity')->nullable();  // Nullable if not applicable to wishlist items
                    $table->decimal('price', 8, 2)->nullable(); // Nullable if not applicable to wishlist items
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('items');
            }
        }
        ```

5. **Order Management**
    - Orders
        ```php
        class CreateOrdersTable extends Migration
        {
            public function up()
            {
                Schema::create('orders', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->foreignId('shipping_id')->constrained('shipping_addresses')->onDelete('cascade');
                    $table->foreignId('payment_id')->constrained('payments')->onDelete('set null');
                    $table->timestamp('order_date');
                    $table->enum('status', ['pending', 'processing', 'shipped', 'completed', 'cancelled']);
                    $table->decimal('total_price', 10, 2)->nullable();
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('orders');
            }
        }
        ```
    - OrderItems
        ```php
       
        ```

6. **Checkout Process**
    - Addresses
        ```php
        class CreateAddressesTable extends Migration
        {
            public function up()
            {
                Schema::create('addresses', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->enum('address_type', ['shipping', 'billing']);  // Enum column for address type
                    $table->string('street_address');
                    $table->string('city');
                    $table->string('state');
                    $table->string('country');
                    $table->string('postal_code');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('addresses');
            }
        }
        ```
    - PaymentMethods
        ```php
        class CreatePaymentMethodsTable extends Migration
        {
            public function up()
            {
                Schema::create('payment_methods', function (Blueprint $table) {
                    $table->id();
                    $table->string('method_name');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('payment_methods');
            }
        }
        ```
    - OrderReviews
        ```php
        class CreateOrderReviewsTable extends Migration
        {
            public function up()
            {
                Schema::create('order_reviews', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('order_id')->constrained()->onDelete('cascade');
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');
                    $table->text('review_text');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('order_reviews');
            }
        }
        ```
    - Invoices
        ```php
        class CreateInvoicesTable extends Migration
        {
            public function up()
            {
                Schema::create('invoices', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('order_id')->constrained()->onDelete('cascade');
                    $table->decimal('total_amount', 8, 2);
                    $table->date('invoice_date');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('invoices');
            }
        }
        ```

7. **Payment Integration**
    - PaymentOptions
        ```php
        class CreatePaymentOptionsTable extends Migration
        {
            public function up()
            {
                Schema::create('payment_options', function (Blueprint $table) {
                    $table->id();
                    $table->string('name')->unique();  // Unique payment option name
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('payment_options');
            }
        }
        ```
    - PaymentTransactions
        ```php
        class CreatePaymentTransactionsTable extends Migration
        {
            public function up()
            {
                Schema::create('payment_transactions', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Reference to Orders table, cascade deletes
                    $table->foreignId('payment_option_id')->constrained('payment_options')->onDelete('cascade');  // Reference to PaymentOptions table, cascade deletes
                    $table->decimal('amount', 8, 2);  // Transaction amount
                    $table->string('transaction_id')->unique();  // Unique transaction identifier
                    $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);  // Transaction status
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('payment_transactions');
            }
        }
        ```

8. **Notifications & Alerts**
    - Notifications

9. **Customer Support & Feedback**
    - FAQs
        ```php
        class CreateFaqsTable extends Migration
        {
            public function up()
            {
                Schema::create('faqs', function (Blueprint $table) {
                    $table->id();
                    $table->string('question');
                    $table->text('answer');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('faqs');
            }
        }
        ```
    - Chats
        ```php
        class CreateChatsTable extends Migration
        {
            public function up()
            {
                Schema::create('chats', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('user_id')
                        ->constrained()
                        ->onDelete('cascade');
                    $table->foreignId('support_agent_id')
                        ->constrained('users')
                        ->onDelete('cascade');
                    $table->text('chat_text');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('chats');
            }
        }
        ```
    - Returns
        ```php
        class CreateReturnsTable extends Migration
        {
            public function up()
            {
                Schema::create('returns', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('order_id')
                        ->constrained()
                        ->onDelete('cascade');
                    $table->text('return_reason');
                    $table->timestamp('return_date');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('returns');
            }
        }
        ```
    - RefundPolicies
        ```php
        class CreateRefundPoliciesTable extends Migration
        {
            public function up()
            {
                Schema::create('refund_policies', function (Blueprint $table) {
                    $table->id();
                    $table->text('policy_text');
                    $table->timestamp('last_updated');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('refund_policies');
            }
        }
        ```

