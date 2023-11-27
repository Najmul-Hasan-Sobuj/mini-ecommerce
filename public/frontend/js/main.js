// Custom_style-start
(function () {
    "use strict";
    window.addEventListener(
        "load",
        function () {
            var form = document.getElementById("needs-validation");
            form.addEventListener(
                "submit",
                function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        },
        false
    );
})();
$(document).ready(function () {
    // Add a change event listener to the radio buttons
    $('input[type="radio"]').change(function () {
        // Remove the 'selected-radio' class from all form-checks
        $(".form-check").removeClass("selected-radio");
        // Add the 'selected-radio' class to the form-check of the selected radio button
        $(this).closest(".form-check").addClass("selected-radio");
    });
});
$(document).ready(function () {
    // Add a change event listener to the radio buttons
    $(".section-radio").change(function () {
        // Collapse all sections
        $(".card .collapse").collapse("hide");
        // Remove the 'active-option' class from all cards
        $(".card").removeClass("active-option");

        // Expand the selected section
        var targetCollapse = $(this).data("target");
        $(targetCollapse).collapse("show");

        // Add the 'active-option' class to the card of the selected radio button
        $(this).closest(".card").addClass("active-option");
    });
});
$(document).ready(function () {
    // Add a change event listener to the radio buttons in the Billing Address section
    $(".section-radio-2").change(function () {
        // If "Same as shipping address" is selected, unselect "Use a different billing address"
        if (
            $(this).prop("checked") &&
            $(this).attr("name") === "same_shipping_address"
        ) {
            $("input[name='difrent_address']").prop("checked", false);
        }

        // If "Use a different billing address" is selected, unselect "Same as shipping address"
        if (
            $(this).prop("checked") &&
            $(this).attr("name") === "difrent_address"
        ) {
            $("input[name='same_shipping_address']").prop("checked", false);
        }

        // Collapse all sections
        $(".card .collapse").collapse("hide");
        // Remove the 'active-option' class from all cards
        $(".card").removeClass("active-option");

        // Expand the selected section
        var targetCollapse = $(this).data("target");
        $(targetCollapse).collapse("show");

        // Add the 'active-option' class to the card of the selected radio button
        $(this).closest(".card").addClass("active-option");
    });
});


{/* Custom  */ }
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) { window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({ scrollTop: 0 }, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    console.log('hello');
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function () {
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity', '0');
    });

    $('.js-hide-modal-search').on('click', function () {
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity', '1');
    });

    $('.container-search-header').on('click', function (e) {
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({ filter: filterValue });
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function () {
        var numProduct = Number($(this).next().val());
        if (numProduct > 0) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function () {
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    // $('.wrap-rating').each(function () { //original code
    //     var item = $(this).find('.item-rating');
    //     var rated = -1;
    //     var input = $(this).find('input');
    //     $(input).val(0);

    //     $(item).on('mouseenter', function () {
    //         var index = item.index(this);
    //         var i = 0;
    //         for (i = 0; i <= index; i++) {
    //             $(item[i]).removeClass('zmdi-star-outline');
    //             $(item[i]).addClass('zmdi-star');
    //         }

    //         for (var j = i; j < item.length; j++) {
    //             $(item[j]).addClass('zmdi-star-outline');
    //             $(item[j]).removeClass('zmdi-star');
    //         }
    //     });

    //     $(item).on('click', function () {
    //         var index = item.index(this);
    //         rated = index;
    //         $(input).val(index + 1);
    //     });

    //     $(this).on('mouseleave', function () {
    //         var i = 0;
    //         for (i = 0; i <= rated; i++) {
    //             $(item[i]).removeClass('zmdi-star-outline');
    //             $(item[i]).addClass('zmdi-star');
    //         }

    //         for (var j = i; j < item.length; j++) {
    //             $(item[j]).addClass('zmdi-star-outline');
    //             $(item[j]).removeClass('zmdi-star');
    //         }
    //     });
    // });

    $(document).ready(function () {
        $('.wrap-rating .item-rating').on('mouseenter', function () {
            var index = $(this).index();
            $(this).prevAll().addBack().removeClass('zmdi-star-outline').addClass('zmdi-star');
            $(this).nextAll().removeClass('zmdi-star').addClass('zmdi-star-outline');
        });

        $('.wrap-rating .item-rating').on('click', function () {
            var rating = $(this).index() + 1;
            $(this).parent().find('input[name="rating_value"]').val(rating);
        });

        $('.wrap-rating').on('mouseleave', function () {
            var currentRating = $(this).find('input[name="rating_value"]').val();
            $(this).find('.item-rating').each(function (index) {
                if (index < currentRating) {
                    $(this).removeClass('zmdi-star-outline').addClass('zmdi-star');
                } else {
                    $(this).removeClass('zmdi-star').addClass('zmdi-star-outline');
                }
            });
        });
    });
    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click', function (e) {
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

    $('.js-hide-modal1').on('click', function () {
        $('.js-modal1').removeClass('show-modal1');
    });



})(jQuery);