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
                    'route' => 'coupon.index',
                    'icon' => 'ph-brandy',
                    'label' => __('Coupon'),
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
            'route' => 'faq.index',
            'icon' => 'ph-gear-six',
            'label' => __('Faq'),
        ],
        [
            'route' => 'refund.policy.index',
            'icon' => 'ph-gear-six',
            'label' => __('Refund Policy'),
        ],
    ];

    $currentRoute = request()
        ->route()
        ->getName();
@endphp

<div class="sidebar-section">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        @foreach ($menuItems as $menuItem)
            @if (isset($menuItem['submenu']))
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link">
                        <i class="{{ $menuItem['icon'] }}"></i>
                        <span>{{ $menuItem['label'] }}</span>
                    </a>
                    <ul
                        class="nav-group-sub collapse {{ collect($menuItem['submenu'])->pluck('route')->contains($currentRoute)? 'show': '' }}">
                        @foreach ($menuItem['submenu'] as $submenuItem)
                            <li class="nav-item">
                                <a href="{{ route($submenuItem['route']) }}"
                                    class="nav-link {{ $currentRoute === $submenuItem['route'] ? 'active' : '' }}">
                                    <i class="{{ $submenuItem['icon'] }}"></i>
                                    {{ $submenuItem['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route($menuItem['route']) }}"
                        class="nav-link {{ $currentRoute === $menuItem['route'] ? 'active' : '' }}">
                        <i class="{{ $menuItem['icon'] }}"></i>
                        <span>{{ $menuItem['label'] }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
