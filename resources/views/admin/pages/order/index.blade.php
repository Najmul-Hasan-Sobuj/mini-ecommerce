<x-admin-layout :title="'Order - ' . config('app.name')">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Customers</h5>
        </div>

        <div class="card-body">
            <div class="chart-container">
                <div class="chart has-fixed-height" id="customers_chart"></div>
            </div>
        </div>

        <table class="table table-striped text-nowrap table-customers">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Registered</th>
                    <th>Email</th>
                    <th>Payment method</th>
                    <th>Orders history</th>
                    <th>Value</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face1.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">James Alexander</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.12.30
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>July 12, 2016</td>
                    <td><a href="#">james@interface.club</a></td>
                    <td>MasterCard</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">25 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">34 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 322.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face2.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Jeremy Victorino</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.03.05
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>September 4, 2016</td>
                    <td><a href="#">jeremy@interface.club</a></td>
                    <td>Cash on delivery</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">43 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">65 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 1,432.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face3.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Margo Baker</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.03.27
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>July 10, 2016</td>
                    <td><a href="#">margo@interface.club</a></td>
                    <td>Paypal</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">38 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">53 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 489.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face4.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Monica Smith</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.10.03
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>June 27, 2016</td>
                    <td><a href="#">monica@interface.club</a></td>
                    <td>Cash on delivery</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">15 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">235 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 940.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face5.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Jemmy Royle</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.11.25
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>January 2, 2016</td>
                    <td><a href="#">jemmy@interface.club</a></td>
                    <td>MasterCard</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">23 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">65 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 772.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face6.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Ashlynn Ben</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.04.14
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>February 25, 2016</td>
                    <td><a href="#">ashlynn@interface.club</a></td>
                    <td>MasterCard</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">23 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">75 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 662.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face7.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Ray Sammy</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.02.20
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>March 20, 2016</td>
                    <td><a href="#">ray@interface.club</a></td>
                    <td>Visa</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">42 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">542 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 499.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face8.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Brian Leslie</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.12.24
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>July 12, 2016</td>
                    <td><a href="#">brian@interface.club</a></td>
                    <td>Paypal</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">14 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">45 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 946.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face9.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Patrick Marilynn</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.09.28
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>October 4, 2016</td>
                    <td><a href="#">patrick@interface.club</a></td>
                    <td>Wire transfer</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">24 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">76 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 538.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="user_pages_profile_tabbed.html" class="d-block me-3">
                                <img src="{{ asset('admin/assets/images/demo/users/face10.jpg') }}" width="40"
                                    height="40" class="rounded-circle" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="user_pages_profile_tabbed.html" class="fw-semibold">Roland Cydney</a>
                                <div class="fs-sm text-muted">
                                    Latest order: 2016.02.12
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>August 1, 2016</td>
                    <td><a href="#">roland@interface.club</a></td>
                    <td>Paypal</td>
                    <td>
                        <div>
                            <i class="ph-clock fs-base lh-base align-top text-danger me-1"></i>
                            Pending:
                            <a href="#">27 orders</a>
                        </div>

                        <div>
                            <i class="ph-check-circle fs-base lh-base align-top text-success me-1"></i>
                            Processed:
                            <a href="#">236 orders</a>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0">&euro; 432.00</h6>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-pdf me-2"></i>
                                    Invoices
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Shipping details
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-coins me-2"></i>
                                    Billing details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="pl-0"></td>
                </tr>

            </tbody>
        </table>
    </div>
</x-admin-layout>
