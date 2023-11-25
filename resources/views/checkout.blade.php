<x-guest-layout :title="'Checkout - ' . config('app.name')">
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4"> Check Out </span>
        </div>
    </div>

    <!-- Shoping Cart -->
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="checkout-info d-flex justify-content-between align-items-center mx-4">
                    <h4 class="fw-bold text-title">Contact</h4>
                    <div>
                        <p>
                            Have an account?
                            <span><a href="" class="link_color">Log in</a></span>
                        </p>
                    </div>
                </div>
                <form class="container mt-4" id="needs-validation" novalidate>
                    <div class="row mx-1">
                        <div class="col-lg-12 col-sm-12 col-12 p-0">
                            <div class="bor8 bg0 m-b-10">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                    id="validationCustom01" placeholder="Email Or Mobile Phone Number" required />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12 p-0 pt-2">
                            <div class="checkbox-wrapper-4">
                                <input class="inp-cbx" id="morning" type="checkbox" />
                                <label class="cbx" for="morning"><span>
                                        <svg width="12px" height="10px">
                                            <use xlink:href="#check-4"></use>
                                        </svg></span><span>Email me with news and offers</span></label>
                                <svg class="inline-svg">
                                    <symbol id="check-4" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </symbol>
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-title my-3">Delivery</h4>
                        <div class="col-lg-12 mt-2 p-0">
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select class="js-select2" name="time">
                                    <option>Select a country...</option>
                                    <option>USA</option>
                                    <option>UK</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12 pl-0 pr-1">
                            <div class="bor8 bg0 m-b-10">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                    id="validationCustom01" placeholder="First" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12 pr-0 check-field">
                            <div class="bor8 bg0 m-b-10">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                    id="validationCustom01" placeholder="Phone" required />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12 p-0">
                            <div class="bor8 bg0 m-b-10">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                    id="validationCustom01" placeholder="Address" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12 pl-0 pr-1 ">
                            <div class="bor8 bg0 m-b-10">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                    id="validationCustom01" placeholder="City" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12 pr-0 check-field">
                            <div class="bor8 bg0 m-b-10">
                                <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                    id="validationCustom01" placeholder="Postal Code" required />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12 p-0 pt-2">
                            <div class="checkbox-wrapper-4">
                                <input class="inp-cbx" id="morning2" type="checkbox" />
                                <label class="cbx" for="morning2"><span>
                                        <svg width="12px" height="10px">
                                            <use xlink:href="#check-4"></use>
                                        </svg></span><span>Save this information for next time</span></label>
                                <svg class="inline-svg">
                                    <symbol id="check-4" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </symbol>
                                </svg>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12 p-0 pt-0">
                            <div class="checkbox-wrapper-4">
                                <input class="inp-cbx" id="morning3" type="checkbox" />
                                <label class="cbx" for="morning3"><span>
                                        <svg width="12px" height="10px">
                                            <use xlink:href="#check-4"></use>
                                        </svg></span><span>Text me with news and offers</span></label>
                                <svg class="inline-svg">
                                    <symbol id="check-4" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </symbol>
                                </svg>
                            </div>
                        </div>
                        <h5 class="mb-2 mt-3" style="color: #000000">Shipping method</h5>
                        <div class="col-lg-12 ml-0 p-0 check-area">
                            <div class="form-check mb-0">
                                <label class="form-check-label d-flex align-items-center py-3 border pl-5"
                                    style="
                      border-top-right-radius: 5px;
                      border-top-left-radius: 5px;
                    ">
                                    <input type="radio" class="form-check-input mr-3 mt-0" name="optradio" />
                                    <div class="row w-100">
                                        <div class="col-lg-10">
                                            <p class="text-dark-black" style="font-size: 14px">
                                                Free Delivery Over 1000 Taka (Inside Dhaka Only)
                                            </p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p class="pl-3 text-right" style="font-size: 14px">
                                                Free
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check mb-0">
                                <label class="form-check-label d-flex align-items-center py-3 border pl-5">
                                    <input type="radio" class="form-check-input mr-3 mt-0" name="optradio" />
                                    <div class="row w-100">
                                        <div class="col-lg-10">
                                            <p class="text-dark-black" style="font-size: 14px">
                                                Inside Dhaka (ঢাকার ভিতরে)
                                            </p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p class="pl-3 text-right" style="font-size: 14px">
                                                ৳70.00
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label d-flex align-items-center py-3 border pl-5"
                                    style="
                      border-bottom-right-radius: 5px;
                      border-bottom-left-radius: 5px;
                    ">
                                    <input type="radio" class="form-check-input mr-3 mt-0" name="optradio" />
                                    <div class="row w-100">
                                        <div class="col-lg-10">
                                            <p class="text-dark-black" style="font-size: 14px">
                                                Sub Dhaka(Keranigonj, Turag, Demra, Diabari,
                                                Purbachal, 100 feet, Bosila, Nowabpur, Dohar,
                                                Kamrangirchar, Doniya,Amin Bazar)
                                            </p>
                                        </div>
                                        <div class="col-lg-2">
                                            <p class="pl-3 text-right" style="font-size: 14px">
                                                ৳100.00
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-title my-3">Payment</h4>
                            <div class="card main-border">
                                <div class="card-header border-0 custom-card-header bg-white">
                                    <h5 class="mb-0">
                                        <label class="mb-0 d-flex align-items-center custom-card-header">
                                            <input type="radio" class="pl-3 section-radio" name="paymentOption"
                                                data-target="#section1" aria-expanded="true" />
                                            <p
                                                style="
                            margin-left: 1rem;
                            font-size: 16px;
                            color: black;
                          ">
                                                SSLCOMMERZ
                                            </p>
                                        </label>
                                    </h5>
                                </div>

                                <div id="section1" class="collapse">
                                    <div class="card-body" style="background-color: #f7f7f7">
                                        <div class="d-flex justify-content-center w-25 mx-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="-252.3 356.1 163 80.9"
                                                class="eHdoK">
                                                <path fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                    stroke-width="2"
                                                    d="M-108.9 404.1v30c0 1.1-.9 2-2 2H-231c-1.1 0-2-.9-2-2v-75c0-1.1.9-2 2-2h120.1c1.1 0 2 .9 2 2v37m-124.1-29h124.1">
                                                </path>
                                                <circle cx="-227.8" cy="361.9" r="1.8" fill="currentColor">
                                                </circle>
                                                <circle cx="-222.2" cy="361.9" r="1.8" fill="currentColor">
                                                </circle>
                                                <circle cx="-216.6" cy="361.9" r="1.8" fill="currentColor">
                                                </circle>
                                                <path fill="none" stroke="currentColor" stroke-miterlimit="10"
                                                    stroke-width="2" d="M-128.7 400.1H-92m-3.6-4.1 4 4.1-4 4.1"></path>
                                            </svg>
                                        </div>
                                        <p class="text-center pt-2">
                                            Pay with Bkash, Nagad, Mastercard, Visa or your bank
                                            through SSLCOMMERZ
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-0 rounded-0">
                                <div class="card-header border-0 custom-card-header bg-white">
                                    <h5 class="mb-0">
                                        <label class="mb-0 d-flex align-items-center custom-card-header">
                                            <input type="radio" class="pl-3 section-radio" name="paymentOption"
                                                data-target="#section2" aria-expanded="false" />
                                            <p
                                                style="
                            margin-left: 1rem;
                            font-size: 16px;
                            color: black;
                          ">
                                                Cash on Delivery (COD)
                                            </p>
                                        </label>
                                    </h5>
                                </div>

                                <div id="section2" class="collapse">
                                    <div class="card-body" style="background-color: #f7f7f7">
                                        <p class="text-center">
                                            Cash On Delivery is only active inside Dhaka.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-0" style="background-color: #dadada; border-top: 0px">
                                <div class="card-header border-0 custom-card-header bg-white">
                                    <h5 class="mb-0">
                                        <label class="mb-0 d-flex align-items-center custom-card-header">
                                            <input type="radio" class="pl-3 section-radio" name="paymentOption"
                                                data-target="#section3" aria-expanded="false" />
                                            <p
                                                style="
                            font-size: 16px;
                            color: black;
                            margin-left: 1rem;
                          ">
                                                Bkash
                                            </p>
                                        </label>
                                    </h5>
                                </div>

                                <div id="section3" class="collapse">
                                    <div class="card-body" style="background-color: #f7f7f7">
                                        <p>
                                            Collect your reference number - <br />
                                            On the next page, you’ll get an order number that you
                                            will have to use as a reference number.<br />
                                            Step 1: Open Bkash app <br />Step 2: Select Make Payment
                                            <br />Step 3: Enter GoodyBro merchant number –
                                            01708729789 <br />Step 4: Enter full ordered amount
                                            <br />Step 5: In the reference box enter previously
                                            collected GoodyBro order number, else we can't process
                                            your order.<br />
                                            Done! You will receive a confirmation call between 11am
                                            - 5pm. P.S: Your order will get canceled automatically
                                            if we can't reach out to you in 2 days.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="text-title my-3">Billing Address</h4>
                            <div class="card main-border">
                                <div class="card-header border-0 custom-card-header bg-white">
                                    <h5 class="mb-0">
                                        <label class="mb-0 d-flex align-items-center custom-card-header">
                                            <input type="radio" class="pl-3 section-radio-2"
                                                name="same_shipping_address" data-target="#section42"
                                                aria-expanded="true" />
                                            <p
                                                style="
                            margin-left: 1rem;
                            font-size: 16px;
                            color: black;
                          ">
                                                Same as shipping address
                                            </p>
                                        </label>
                                    </h5>
                                </div>

                                <div id="section42" class="collapse">
                                    <!-- No Text Here -->
                                </div>
                            </div>
                            <div class="card mt-0">
                                <div class="card-header border-0 custom-card-header bg-white">
                                    <h5 class="mb-0">
                                        <label class="mb-0 d-flex align-items-center custom-card-header">
                                            <input type="radio" class="pl-3 section-radio-2" name="difrent_address"
                                                data-target="#section41" aria-expanded="false" />
                                            <p
                                                style="
                            margin-left: 1rem;
                            font-size: 16px;
                            color: black;
                          ">
                                                Use a different billing address
                                            </p>
                                        </label>
                                    </h5>
                                </div>

                                <div id="section41" class="collapse">
                                    <div class="card-body pt-0" style="background-color: #f7f7f7">
                                        <div class="row p-2">
                                            <div class="col-lg-12 p-0">
                                                <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                                    <select class="js-select2" name="time">
                                                        <option>Select a country...</option>
                                                        <option>USA</option>
                                                        <option>UK</option>
                                                    </select>
                                                    <div class="dropDownSelect2"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12 pl-0 pr-1">
                                                <div class="bor8 bg0 m-b-10">
                                                    <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                                        id="validationCustom01" placeholder="First Name" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12 pr-0">
                                                <div class="bor8 bg0 m-b-10">
                                                    <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                                        id="validationCustom01" placeholder="Phone" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-12 p-0">
                                                <div class="bor8 bg0 m-b-10">
                                                    <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                                        id="validationCustom01" placeholder="Address" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12 pl-0 pr-1 ">
                                                <div class="bor8 bg0 m-b-10">
                                                    <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                                        id="validationCustom01" placeholder="City" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12 col-12 pr-0 check-field">
                                                <div class="bor8 bg0 m-b-10">
                                                    <input type="text" class="stext-111 cl8 plh3 size-111 p-lr-15"
                                                        id="validationCustom01" placeholder="Postal Code" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 mb-5">
                        <div class="col-lg-12 col-sm-12 col-12 text-center">
                            <a href=""
                                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="checkout-sidebar-info-main">
                    <div class="row align-items-center">
                        <div class="col-lg-12 mb-2">
                            <div class="d-flex justify-content-between p-2"
                                style="background-color: #f7f7f7; border-radius: 5px">
                                <a href="">
                                    <div class="header-cart-item-img">
                                        <span class="badge badge-dark rounded-circle count-label">1</span>
                                        <img class="img-fluid rounded"
                                            src="https://cdn.shopify.com/s/files/1/0103/5704/7332/files/7_2_64x64.png?v=1698831801"
                                            alt="IMG" />
                                    </div>
                                </a>
                                <div class="w-75">
                                    <p class="p-0 m-0 pt-2">Round Neck Emerald Half Sleeve</p>
                                    <p class="p-0 m-0">2XS</p>
                                </div>
                                <div>
                                    <p class="p-0 m-0 mt-4 text-info">৳299.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2">
                            <div class="d-flex justify-content-between p-2"
                                style="background-color: #f7f7f7; border-radius: 5px">
                                <a href="">
                                    <div class="header-cart-item-img">
                                        <span class="badge badge-dark rounded-circle count-label">1</span>
                                        <img class="img-fluid rounded"
                                            src="https://cdn.shopify.com/s/files/1/0103/5704/7332/files/7_2_64x64.png?v=1698831801"
                                            alt="IMG" />
                                    </div>
                                </a>
                                <div class="w-75">
                                    <p class="p-0 m-0 pt-2">Round Neck Emerald Half Sleeve</p>
                                    <p class="p-0 m-0">2XS</p>
                                </div>
                                <div>
                                    <p class="p-0 m-0 mt-4 text-info">৳299.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="">
                        <div class="row g-0 mt-5">
                            <div class="col-lg-12 pr-1 check-field bg0 m-b-12">
                                <div class="flex-w flex-m m-r-20 m-tb-5 justify-content-between">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <input
                                                    class="stext-104 w-100 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5"
                                                    type="text" name="coupon" placeholder="Coupon Code">
                                            </div>
                                            <div class="col-lg-2">
                                                <a
                                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                                    Apply coupon
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-5">
                        <div class="col-lg-12 col-sm-12">
                            <div class="d-flex justify-content-between">
                                <p class="text-left pb-2">Subtotal</p>
                                <p class="text-right">৳299.00</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="text-left pb-2">Shipping</p>
                                <p class="text-right">৳70.00</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="text-left pb-2">Estimated taxes</p>
                                <p class="text-right">৳22.43</p>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between pt-4">
                                <h6 class="text-left pb-2 bold text-black" style="color: #000000; font-weight: bold">
                                    Total(Including 7.5% VAT)
                                </h6>
                                <h6 class="text-right">
                                    BDT
                                    <span style="color: #000000; font-weight: bold">৳391.43</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


@push('scripts')
    {{-- empty --}}
@endpush
