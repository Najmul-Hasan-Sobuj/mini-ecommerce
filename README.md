# Mini E-commerce Project 

## Project Structure

1. **User Management**
   - Registration & Login
   - Profiles
   - Password Recovery

2. **Product Management**
   - Products
   - Categories & Subcategories
   - Images, Reviews & Ratings

3. **Search & Filtering**
   - Brands

4. **Cart & Wishlist**

5. **Order Management**
   - Orders
   - Order Items

6. **Checkout Process**
   - Addresses
   - Payment Methods

7. **Payment Integration**
   - Payment Options
   - Payment Transactions

8. **Notifications & Alerts**

9. **Customer Support & Feedback**
   - FAQs
   - Chats
   - Refund Policies

This streamlined project structure provides a clear and concise overview of the system's key components and modules.

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
                    $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
                    $table->timestamp('order_date')->useCurrent();
                    $table->timestamp('shipped_date')->nullable();
                    $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'return'])->default('pending');
                    $table->decimal('subtotal', 8, 2)->default(0.00);
                    $table->decimal('tax', 8, 2)->default(0.00);
                    $table->decimal('shipping_cost', 8, 2)->default(0.00);
                    $table->decimal('total_price', 8, 2)->default(0.00);
                    $table->date('return_date')->nullable();
                    $table->text('return_reason')->nullable();
                    $table->double('return_amount', 10, 2)->nullable();
                    $table->text('notes')->nullable();
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
        class CreateOrderItemsTable extends Migration
        {
            public function up()
            {
                Schema::create('order_items', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('order_id')->constrained()->onDelete('cascade');
                    $table->foreignId('product_id')->constrained()->onDelete('cascade');
                    $table->string('product_name');
                    $table->string('product_sku');
                    $table->unsignedInteger('quantity');
                    $table->decimal('unit_price', 8, 2);
                    $table->decimal('total_price', 8, 2);
                    $table->text('special_instructions')->nullable();
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('order_items');
            }
        }
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
                    $table->string('slug')->unique();
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
                    $table->integer('order')->unsigned();
                    $table->enum('status', ['active', 'inactive'])->default('active');
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
                    $table->text('chat_message');
                    $table->timestamps();
                });
            }

            public function down()
            {
                Schema::dropIfExists('chats');
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

