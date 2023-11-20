<!-- Cart -->

<ul class="header-cart-wrapitem w-full">
    @php
        $cartItems = Session::get('cart');
        $total = 0;
    @endphp
    @if ($cartItems)
        @foreach ($cartItems as $id => $cartItem)
            @php $total += $cartItem['price'] * $cartItem['quantity'] @endphp
            <li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img" id="{{ $id }}" onclick="deleteRow(this.id)">
                    <img src="{{ asset('storage/' . $cartItem['image']) }}" alt="{{ $cartItem['name'] }}">
                </div>

                <div class="header-cart-item-txt p-t-8">
                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                        {{ $cartItem['name'] }}
                    </a>

                    <span class="header-cart-item-info">
                        {{ $cartItem['quantity'] }} x ${{ $cartItem['price'] }}
                    </span>
                </div>
            </li>
        @endforeach
    @endif
</ul>

<div class="w-full">
    <div class="header-cart-total w-full p-tb-40">
        Total: ${{ $total }}
    </div>

    <div class="header-cart-buttons flex-w w-full">
        <a href="{{ route('shoping.cart') }}"
            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
            View Cart
        </a>

        <a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
            Check Out
        </a>
    </div>
</div>
