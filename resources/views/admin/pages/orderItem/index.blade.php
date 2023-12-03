<x-admin-layout :title="'Order Items - ' . config('app.name')">
    <!-- Orders history (datatable) -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Orders history (Datatable)</h5>
        </div>

        <table class="table table-orders-history-dt text-nowrap">
            <thead>
                <tr>
                    {{-- <th>Status</th> --}}
                    <th>Product name</th>
                    <th>Size</th>
                    <th>Colour</th>
                    <th>Article number</th>
                    <th>Units</th>
                    <th>Price</th>
                    <th class="text-center"><i class="ph-dots-three"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    {{-- <td>1. New orders</td> --}}
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="#" class="me-3">
                                <img src="../../../assets/images/demo/products/1.jpeg" height="60" alt="">
                            </a>

                            <div class="flex-fill">
                                <a href="#" class="d-block fw-semibold">Fathom Backpack</a>
                                <div class="d-inline-flex align-items-center text-muted fs-sm">
                                    <span class="bg-secondary rounded-pill p-1 me-1"></span>
                                    Processing
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>34cm x 29cm</td>
                    <td>Orange</td>
                    <td>
                        <a href="#">1237749</a>
                    </td>
                    <td>1</td>
                    <td>
                        <h6 class="mb-0">&euro; 79.00</h6>
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                <i class="ph-list"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">
                                    <i class="ph-truck me-2"></i>
                                    Track parcel
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-file-arrow-down me-2"></i>
                                    Download invoice
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-wallet me-2"></i>
                                    Payment details
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class="ph-warning-circle me-2"></i>
                                    Report problem
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /orders history (datatable) -->
    @push('scripts')
        <script>
            $('.table-orders-history-dt').DataTable({
                dom: '<"datatable-header justify-content-start"f<"ms-sm-auto"l><"ms-sm-3"B>><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [6],
                }],
            });
        </script>
    @endpush

</x-admin-layout>
