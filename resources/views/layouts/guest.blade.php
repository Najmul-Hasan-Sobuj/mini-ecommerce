<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="icon" type="image/png" href="{{ asset('frontend/images/icons/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
</head>

<body class="animsition">

    <!-- Header -->
    @include('layouts.header')

    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Your Cart
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>
            <div class="header-cart-content flex-w js-pscroll">
                @include('layouts.cart-header')
            </div>
        </div>
    </div>

    {{ $slot }}
    <!-- Footer -->
    @include('layouts.footer')

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>



    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/select2/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        @php
            $cartAll = Session::get('cart', []);
            $total = 0;
            if (!empty($cartAll) && array_key_exists('products', $cartAll)) {
                $cart = $cartAll['products'];
                $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            }
        @endphp
        $(document).ready(function() {
            $('.shipping_method input[type="radio"]').change(function() {
                var shipping_cost = $('input[name="shipping_cost"]:checked').val();
                $('.shipping_cost_value').val(shipping_cost);
                var total_value = parseFloat({{ $total }}) + parseFloat(shipping_cost);
                $('.shipping').text(shipping_cost);
                $('.total_value_show').text(total_value);
                $('.total_value').val(total_value);
            });
        });
    </script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $(document).on('click', '.js-addcart-detail', function() {
            var $this = $(this);
            var formData = {
                productId: $this.data('id'),
                productQuantity: $this.data('quantity')
            };

            $.ajax({
                url: "/add-to-cart",
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    swal(response.productName, " is added to cart!", "success");
                    $('.header-cart-content').html(response.cartHeader);
                    $('.icon-header-noti').attr('data-notify', response.cartCount);
                },
                error: function(xhr) {
                    swal("Error", "There was an error adding the product to the cart.", "error");
                }
            });
        });


        function deleteRow(rowId) {
            var cartHead = $('.header-cart-content');
            var cartContainer = $('.cart_product');
            var listItem = $(`li[data-row-id="${rowId}"]`);
            var iconHeaderNoti = $('.icon-header-noti');

            $.ajax({
                type: 'GET',
                url: `cart-remove/${rowId}`,
                success: function(data) {
                    swal(data.name, "is removed from the cart.", "success");
                    cartHead.html(data.cartHeader);
                    cartContainer.html(data.html);
                    listItem.remove();
                    iconHeaderNoti.attr('data-notify', data.cartCount);
                    $('.js-select2').select2();
                }
            });
        }

        //-----  CART INCREMENT
        function increaseCount(event, buttonElement, rowId) {
            event.preventDefault();

            var input = $(buttonElement).closest('.cart-item').find('.input-qty');
            var value = parseInt(input.val(), 10);
            value = isNaN(value) ? 0 : value;
            value++;
            input.val(value);

            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        swal(data.name, "Quantity increased!", "success");
                        $('.header-cart-content').html(data.cartHeader);
                        $('.cart_product').empty().html(data.html);
                        $('.icon-header-noti').attr('data-notify', data.cartCount);
                        $('.js-select2').select2();
                    } else {
                        swal("Error", "Item not found in cart", "error");
                    }
                },
                error: function() {
                    swal("Error", "Unable to increment the item", "error");
                }
            });
        }


        // -------- CART Decrement  --------//

        function decreaseCount(event, buttonElement, rowId) {
            event.preventDefault();

            var input = $(buttonElement).closest('.cart-item').find('.input-qty');
            var value = parseInt(input.val(), 10);
            value = (isNaN(value) || value <= 1) ? 0 : value - 1;
            input.val(value);

            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        if (data.itemRemoved) {
                            swal("Item removed", "The item has been removed from the cart", "success");
                            $(buttonElement).closest('.cart-item').remove();
                        } else {
                            swal(data.name, "Quantity decreased!", "success");
                        }
                        $('.header-cart-content').html(data.cartHeader);
                        $('.cart_product').empty().html(data.html);
                        $('.icon-header-noti').attr('data-notify', data.cartCount);
                        $('.js-select2').select2();
                    } else {
                        swal("Error", data.error, "error");
                    }
                },
                error: function() {
                    swal("Error", "Unable to decrement the item", "error");
                }
            });
        }


        //-------------- Cart Quantity Change ------- //

        function quantityChange(event, id, value) {
            event.preventDefault();
            const cartHead = $('.header-cart-content');
            const cartContainer = $('.cart_product');

            $.ajax({
                url: `/cart/quantity/change/${id}`,
                type: 'POST',
                data: {
                    quantity: value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal(data.name, "Quantity changed in cart!", "success");
                    cartHead.html(data.cartHeader);
                    cartContainer.html(data.html);
                    $('.icon-header-noti').attr('data-notify', data.cartCount);
                    $('.js-select2').select2();
                },
                error: function(xhr) {
                    swal("Error", "There was an error: " + xhr.responseText, "error");
                }
            });
        };

        function emptyCart(event) {
            const cartHead = $('.header-cart-content');
            const cartContainer = $('.cart_product');
            const iconHeaderNoti = $('.icon-header-noti');

            $.ajax({
                type: 'GET',
                url: "{{ route('cart.clear') }}",
                dataType: 'json',
                success: function(data) {
                    cartContainer.html(data);
                    cartHead.html(data.cartHeader);
                    swal("Cart", "Cleared Successfully !", "success");
                    iconHeaderNoti.attr('data-notify', data.cartCount);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var obj = {};
            obj.cus_name = $('#customer_name').val();
            obj.cus_phone = $('#mobile').val();
            obj.cus_email = $('#email').val();
            obj.cus_addr1 = $('#address').val();
            obj.amount = $('#total_amount_ssl').val();

            $('#sslczPayBtn').prop('postdata', obj);

            (function(window, document) {
                var loader = function() {
                    var script = document.createElement("script"),
                        tag = document.getElementsByTagName("script")[0];
                    script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(7);
                    tag.parentNode.insertBefore(script, tag);
                };

                window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent(
                    "onload", loader);
            })(window, document);
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->


    <!--===============================================================================================-->

    @yield('scripts')

    <!--===============================================================================================-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="{{ asset('frontend/js/map-custom.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
