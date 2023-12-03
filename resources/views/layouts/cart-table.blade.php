<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
    <div class="m-l-25 m-r--38 m-lr-0-xl">
        <div class="wrap-table-shopping-cart">
            <table class="table-shopping-cart">
                <tr class="table_head">
                    <th class="column-1">Product Thumbnail</th>
                    <th class="column-2">Product </th>
                    <th class="column-3">Price</th>
                    <th class="column-4">Quantity</th>
                    <th class="column-5">Total</th>
                    <th class="column-6">
                        <a href="javascript:void(0);" class="text-danger mr-3" onclick='emptyCart(event)'>Empty Cart</a>
                    </th>
                </tr>
                @if ($cartItems)
                    @foreach ($cartItems as $id => $item)
                        <tr class="table_row">
                            <td class="column-1">
                                <div class="how-itemcart1">
                                    <img src="{{ asset('frontend/images/item-cart-04.jpg') }}" alt="IMG">
                                </div>
                            </td>
                            <td class="column-2">{{ $item['name'] }}</td>
                            <td class="column-3">$ {{ $item['price'] }}</td>
                            <td class="column-4">
                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                    <button type="button" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                                        id="{{ $id }}"
                                        onclick="decreaseCount(event, this, '{{ $id }}')">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </button>
                                    <!-- Change Quantity -->
                                    <input id="{{ $id }}" min="1" name="quantity" type="number"
                                        value="{{ $item['quantity'] }}"
                                        class="mtext-104 cl3 txt-center num-product input-cart-qty"
                                        onchange="quantityChange(event, '{{ $id }}', this.value)" />
                                    <!-- Increment Quantity -->
                                    <button type="button" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                                        id="{{ $id }}"
                                        onclick="increaseCount(event, this, '{{ $id }}')">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="column-5">$ {{ $item['price'] * $item['quantity'] }}</td>
                            <td class="column-6">
                                <a href="JavaScript:void(0)" class="mr-4" title="Remove this item"
                                    id="{{ $id }}" onclick="deleteRow(this.id)">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>

<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
        <h4 class="mtext-109 cl2 p-b-30">
            Cart Totals
        </h4>

        <div class="flex-w flex-t bor12 p-b-13">
            <div class="size-208">
                <span class="stext-110 cl2">
                    Subtotal:
                </span>
            </div>

            <div class="size-209">
                <span class="mtext-110 cl2">
                    $79.65
                </span>
            </div>
        </div>

        <div class="flex-w flex-t p-t-27 p-b-33">
            <div class="size-208">
                <span class="mtext-101 cl2">
                    Total:
                </span>
            </div>

            <div class="size-209 p-t-1">
                <span class="mtext-110 cl2">
                    $79.65
                </span>
            </div>
        </div>

        <a href="{{ route('checkout') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
            Checkout
        </a>
    </div>
</div>
