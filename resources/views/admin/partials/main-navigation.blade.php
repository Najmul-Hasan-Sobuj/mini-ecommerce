@php
    $menuItems = [
        [
            'route' => 'admin.index',
            'icon' => 'ph-house',
            'label' => __('Home'),
        ],
        [
            'route' => 'category.index',
            'icon' => 'ph-equalizer',
            'label' => __('Category'),
        ],
        [
            'icon' => 'ph-keyhole',
            'label' => 'Brand',
            'submenu' => [
                [
                    'route' => 'brand.index',
                    'icon' => 'ph-brandy',
                    'label' => __('Brand'),
                ],
                [
                    'route' => 'product.index',
                    'icon' => 'ph-brandy',
                    'label' => __('Product'),
                ],
                [
                    'route' => 'product.review.index',
                    'icon' => 'ph-brandy',
                    'label' => __('Product Review'),
                ],
                [
                    'route' => 'coupon.index',
                    'icon' => 'ph-brandy',
                    'label' => __('Coupon'),
                ],
                [
                    'route' => 'order.index',
                    'icon' => 'ph-brandy',
                    'label' => __('Orders'),
                ],
            ],
        ],
        [
            'route' => 'paymentMethod.index',
            'icon' => 'ph-gear-six',
            'label' => __('Payment Method'),
        ],
        [
            'route' => 'payment.transaction.index',
            'icon' => 'ph-gear-six',
            'label' => __('Payment Transaction'),
        ],

        [
            'route' => 'refund.policy.index',
            'icon' => 'ph-gear-six',
            'label' => __('Refund Policy'),
        ],
        [
            'icon' => 'ph-keyhole',
            'label' => 'CRM',
            'submenu' => [
                [
                    'route' => 'faq.index',
                    'icon' => 'ph-gear-six',
                    'label' => __('Faq'),
                ],
                [
                    'route' => 'contact.index',
                    'icon' => 'ph-gear-six',
                    'label' => __('Contact'),
                ],
            ],
        ],
    ];

    $currentRoute = request()->route()
        ? request()
            ->route()
            ->getName()
        : null;
@endphp

<div class="sidebar-section">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        @foreach ($menuItems as $menuItem)
            @if (isset($menuItem['submenu']))
                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="{{ $menuItem['icon'] }}"></i>
                        <span>{{ $menuItem['label'] }}</span>
                    </a>
                    <ul
                        class="nav-group-sub collapse {{ collect($menuItem['submenu'])->pluck('route')->contains($currentRoute)? 'show': '' }}">
                        @foreach ($menuItem['submenu'] as $submenuItem)
                            @if (Route::has($submenuItem['route']))
                                <li class="nav-item">
                                    <a href="{{ route($submenuItem['route']) }}"
                                        class="nav-link {{ $currentRoute === $submenuItem['route'] ? 'active' : '' }}">
                                        <i class="{{ $submenuItem['icon'] }}"></i>
                                        {{ $submenuItem['label'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                @if (Route::has($menuItem['route']))
                    <li class="nav-item">
                        <a href="{{ route($menuItem['route']) }}"
                            class="nav-link {{ $currentRoute === $menuItem['route'] ? 'active' : '' }}">
                            <i class="{{ $menuItem['icon'] }}"></i>
                            <span>{{ $menuItem['label'] }}</span>
                        </a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
