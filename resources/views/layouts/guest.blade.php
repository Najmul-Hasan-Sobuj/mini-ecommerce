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

    <!-- Modal1 -->
    {{-- <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('frontend/images/icons/icon-close.png') }}" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3"
                                        data-thumb="{{ asset('frontend/images/product-detail-01.jpg') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('frontend/images/product-detail-01.jpg') }}"
                                                alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset('frontend/images/product-detail-01.jpg') }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3"
                                        data-thumb="{{ asset('frontend/images/product-detail-02.jpg') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('frontend/images/product-detail-02.jpg') }}"
                                                alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset('frontend/images/product-detail-02.jpg') }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3"
                                        data-thumb="{{ asset('frontend/images/product-detail-03.jpg') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('frontend/images/product-detail-03.jpg') }}"
                                                alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset('frontend/images/product-detail-03.jpg') }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                Lightweight Jacket
                            </h4>

                            <span class="mtext-106 cl2">
                                $58.79
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat
                                ornare feugiat.
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Size S</option>
                                                <option>Size M</option>
                                                <option>Size L</option>
                                                <option>Size XL</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Red</option>
                                                <option>Blue</option>
                                                <option>White</option>
                                                <option>Grey</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                        class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                        data-tooltip="Add to Wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                }
            });
        }

        //-----  CART INCREMENT
        function increaseCount(a, b, c) {
            var input = $('.input-qty').val();
            var cartHead = $('.header-cart-content');
            var value = parseInt(input.value, 10);
            var cartContainer = $('.cart_product');
            value = isNaN(value) ? 0 : value;
            value++;
            input.value = value;
            var rowId = c;
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    swal(data.name, "increased one item!", "success");
                    cartHead.html(data.cartHeader);
                    cartContainer.empty(data);
                    cartContainer.html(data.html);
                    $('.icon-header-noti').attr('data-notify', data.cartCount);
                }
            });


        }
        // -------- CART Decrement  --------//

        function decreaseCount(a, b, c) {
            var cartHead = $('.header-cart-content');
            var input = $('.input-qty').val();
            var value = parseInt(input.value, 10);
            if (value > 1) {
                value = isNaN(value) ? 0 : value;
                value--;
                input.value = value;
            }

            var form = $(this).closest('.myForm');
            var rowId = c;
            var cartContainer = $('.cart_product');
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    swal(data.name, "decreased one item.", "success");
                    cartContainer.empty(data);
                    cartHead.html(data.cartHeader);
                    cartContainer.html(data.html);
                    $('.icon-header-noti').attr('data-notify', data.cartCount);
                    cartTotal.text(data.total);
                }
            });
        }

        //-------------- Cart Quantity Change ------- //
        function quantityChange(a, b, id, value) {
            a.preventDefault;
            var cartHead = $('.header-cart-content');
            var cartContainer = $('.cart_product');
            var quantity = value;
            var id = id;

            $.ajax({
                url: '{{ route('cart.quantity.change') }}',
                type: 'POST',
                data: {
                    quantity: quantity,
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(data) {
                    swal(data.name, "quantity changed in cart!", "success");
                    cartHead.html(data.cartHeader);
                    cartContainer.empty(data);
                    cartContainer.html(data.html);
                    $('.icon-header-noti').attr('data-notify', data.cartCount);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    swal("Error", "There was an error adding the product to the cart.",
                        "error");
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
    <script src="{{ asset('frontend/js/map-custom.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
