# Mini E-commerce Project 

## Project Structure

1. **User Management**
   - *Registration & Login:* Users can create accounts by providing their email and password. They can log in securely using their credentials.
   - *Profiles:* Users can update their profiles, including personal information, contact details, and profile pictures.
   - *Password Recovery:* If users forget their passwords, they can request a password recovery link sent to their email.

2. **Product Management**
   - *Products:* The system stores information about various products, including names, descriptions, prices, and availability.
   - *Categories & Subcategories:* Products are organized into categories (e.g., Electronics) and subcategories (e.g., Smartphones) to simplify navigation.
   - *Images, Reviews & Ratings:* Users can view product images, leave reviews, and rate products on a scale of 1 to 5 stars.

3. **Search & Filtering**
   - *Brands:* Users can filter products by brands (e.g., Apple, Samsung) to find products from their preferred manufacturers.

4. **Cart & Wishlist**
   - *Carts & Wishlist:* Users can add products to their shopping carts for immediate purchase or to their wishlists for future consideration.

5. **Order Management**
   - *Orders:* Users can place orders for selected products, specify shipping details, and track the order's status (e.g., pending, shipped).
   - *Order Items:* Each order contains a list of items with details such as product name, quantity, and price.

6. **Checkout Process**
   - *Addresses:* Users can save and manage multiple addresses for shipping and billing during the checkout process.
   - *Payment Methods:* Users can choose from available payment methods, such as credit card, PayPal, or cash on delivery.

7. **Payment Integration**
   - *Payment Options:* Payment options include credit/debit cards, digital wallets, and other methods accepted by the system.
   - *Payment Transactions:* Records transactions, including payment amount, unique transaction ID, and status (e.g., completed, pending).

8. **Notifications & Alerts**
   - *Notifications:* Users receive notifications about order updates, promotions, and important announcements via email or in-app messages.

9. **Customer Support & Feedback**
   - *FAQs:* Users can browse a list of frequently asked questions and find answers to common queries.
   - *Chats:* Users can engage in real-time chat conversations with customer support agents for assistance.
   - *Refund Policies:* Refund policies detail the conditions and procedures for requesting returns or refunds for purchased items.

These examples showcase how each component and module contributes to the overall functionality of the system, providing users with a seamless and comprehensive online shopping experience.

## Project Database

1. **User Management** `laravel breeze authentication system`
    - Registration & Login
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
                    $table->foreignId('category_id')->constrained()->onDelete('cascade');
                    $table->string('name');
                    $table->string('slug')->unique();
                    $table->string('image');
                    $table->string('sku')->unique()->nullable();  // Unique Stock Keeping Unit
                    $table->text('description');
                    $table->unsignedDecimal('price', 8, 2)->unsigned();
                    $table->unsignedInteger('quantity')->default(0);  // Quantity in stock
                    $table->enum('status', ['active', 'inactive']);  // Enum column for status 
                    $table->foreignId('created_by')->constrained('users')->nullable()->onDelete('set null');  // Who created this product?
                    $table->foreignId('updated_by')->constrained('users')->nullable()->onDelete('set null');  // Who last updated this product?
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            $productId = $this->product;

            return [
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|unique:products,slug,{$productId}",
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
                'sku' => "nullable|string|max:255|unique:products,sku,{$productId}",
                'description' => 'required|string',
                'price' => 'required|numeric|between:0,999999.99',
                'quantity' => 'required|integer|min:0',
                'status' => 'required|enum:products,status',
                'created_by' => 'nullable|exists:users,id',
                'updated_by' => 'nullable|exists:users,id',
            ];
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
                    $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('set null'); // Self-referential foreign key
                    $table->string('name')->unique();
                    $table->string('slug')->unique();
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        $categoryId = $this->category; // Assuming the route parameter is named 'category'

        return [
            'parent_id' => 'nullable|exists:categories,id',
            'name' => "required|string|max:255|unique:categories,name,{$categoryId}",
            'slug' => "required|string|max:255|unique:categories,slug,{$categoryId}",
        ];
        ```
    - ProductImages
        ```php
         class CreateProductImagesTable extends Migration
        {
            public function up()
            {
                Schema::create('product_images', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('product_id')->constrained()->onDelete('cascade'); 
                    $table->string('images');
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'product_id' => 'required|exists:products,id',
                'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
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
                    $table->foreignId('product_id')->constrained()->onDelete('cascade');  
                    $table->foreignId('user_id')->constrained()->onDelete('cascade');  
                    $table->text('review_text')->nullable();  // Nullable as it may not be required always
                    $table->unsignedTinyInteger('rating_value')->nullable();  // Nullable as it may not be required always
                    $table->enum('is_verified', ['true', 'false'])->default('false');
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'product_id' => 'required|exists:products,id',
                'user_id' => 'required|exists:users,id',
                'review_text' => 'nullable|string',
                'rating_value' => 'nullable|integer|min:1|max:5',  // Assuming a rating scale of 1-5
                'is_verified' => 'required|in:true,false',
            ];
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
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            $brandId = $this->brand; // Assuming the route parameter is named 'brand'

            return [
                'name' => "required|string|max:255|unique:brands,name,{$brandId}",
                'slug' => "required|string|max:255|unique:brands,slug,{$brandId}",
            ];
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
                    $table->unsignedInteger('quantity')->nullable()->default(0);  // Nullable if not applicable to wishlist items
                    $table->unsignedDecimal('price', 8, 2)->nullable()->unsigned(); // Nullable if not applicable to wishlist items
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'type' => 'required|in:cart,wishlist',
                'user_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'nullable|integer|min:0',
                'price' => 'nullable|numeric|between:0,999999.99',
            ];
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
                    $table->unsignedDecimal('subtotal', 8, 2)->default(0.00);
                    $table->unsignedDecimal('tax', 8, 2)->default(0.00);
                    $table->unsignedDecimal('shipping_cost', 8, 2)->default(0.00);
                    $table->unsignedDecimal('total_price', 8, 2)->default(0.00);
                    $table->date('return_date')->nullable();
                    $table->text('return_reason')->nullable();
                    $table->double('return_amount', 10, 2)->nullable();
                    $table->text('notes')->nullable();
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'user_id' => 'required|exists:users,id',
                'address_id' => 'required|exists:addresses,id',
                'order_date' => 'required|date',
                'shipped_date' => 'nullable|date|after_or_equal:order_date',
                'status' => 'required|in:pending,processing,shipped,delivered,cancelled,return',
                'subtotal' => 'required|numeric|between:0,999999.99',
                'tax' => 'required|numeric|between:0,999999.99',
                'shipping_cost' => 'required|numeric|between:0,999999.99',
                'total_price' => 'required|numeric|between:0,999999.99',
                'return_date' => 'nullable|date|after:order_date',
                'return_reason' => 'nullable|string',
                'return_amount' => 'nullable|numeric|between:0,9999999999.99',
                'notes' => 'nullable|string',
            ];
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
                    $table->unsignedInteger('quantity')->nullable()->default(0);
                    $table->unsignedDecimal('unit_price', 8, 2);
                    $table->unsignedDecimal('total_price', 8, 2);
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'order_id' => 'required|exists:orders,id',
                'product_id' => 'required|exists:products,id',
                'product_name' => 'required|string|max:255',
                'product_sku' => 'required|string|max:255',
                'quantity' => 'nullable|integer|min:0',
                'unit_price' => 'required|numeric|between:0,999999.99',
                'total_price' => 'required|numeric|between:0,999999.99',
                'special_instructions' => 'nullable|string',
            ];
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
                    $table->string('postal_code', 10);
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'user_id' => 'required|exists:users,id',
                'address_type' => 'required|in:shipping,billing',
                'street_address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'postal_code' => 'required|string|max:10',
            ];
        }
        ```


7. **Payment Integration**
    - PaymentMethods
        ```php
        class CreatePaymentMethodsTable extends Migration
        {
            public function up()
            {
                Schema::create('payment_methods', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('slug')->unique();
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            $paymentMethodId = $this->payment_method; // Assuming the route parameter is named 'payment_method'

            return [
                'name' => 'required|string|max:255',
                'slug' => "required|string|max:255|unique:payment_methods,slug,{$paymentMethodId}",
            ];
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
                    $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');  // Reference to PaymentMethods table, cascade deletes
                    $table->unsignedDecimal('amount', 8, 2);  // Transaction amount
                    $table->string('transaction_id')->unique();  // Unique transaction identifier
                    $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);  // Transaction status
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'order_id' => 'required|exists:orders,id',
                'payment_method_id' => 'required|exists:payment_methods,id',
                'amount' => 'required|numeric|between:0,999999.99',
                'transaction_id' => 'required|string|max:255|unique:payment_transactions,transaction_id',
                'status' => 'required|in:pending,completed,failed,refunded',
            ];
        }
        ```

8. **Notifications & Alerts**
    - Notifications
    `php artisan notifications:table` command generates a new database migration file that includes the schema for a notifications table. This table will hold information about the notifications, including type, JSON data, and other meta-information. After running this command, you will find the new migration file in your `database/migrations` directory.

    Once the migration file is generated, you can run `php artisan migrate` to apply the changes to your database. This will create the notifications table based on the schema defined in the migration file.

    Here's a brief overview of the steps:

    1. Generate the migration file for the notifications table:
    ```
    php artisan notifications:table
    ```

    2. You'll find the migration file in the `database/migrations` directory. You can review or modify this file if needed.

    3. Apply the migration to create the table in your database:
    ```
    php artisan migrate
    ```
    After completing these steps, your database should now have a new table named `notifications` where you can store and query notifications for your application.

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
                    $table->unsignedInteger('order')->nullable();
                    $table->enum('status', ['active', 'inactive'])->default('active');
                    $table->text('answer');
                    $table->timestamps();
                });
            }
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'question' => 'required|string|max:255',
                'order' => 'nullable|integer|min:1',
                'status' => 'required|in:active,inactive',
                'answer' => 'required|string',
            ];
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
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'user_id' => 'required|exists:users,id',
                'support_agent_id' => 'required|exists:users,id|different:user_id',
                'chat_message' => 'required|string',
            ];
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
            // ... rest of the code
        }
        ```

        ```php
        public function rules()
        {
            return [
                'policy_text' => 'required|string',
                'last_updated' => 'required|date',
            ];
        }
        ```

