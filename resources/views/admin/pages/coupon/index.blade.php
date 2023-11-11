<x-admin-layout :title="'Coupon - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#couponAddModal"
                            class="btn btn-flat-success btn-labeled btn-labeled-start btn-sm">
                            <span class="btn-labeled-icon bg-success text-white">
                                <i class="ph-plus-circle ph-sm"></i>
                            </span>
                            Add
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table
                            class="data-table-coupon table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="20%">Category</th>
                                    <th width="30%">Question</th>
                                    <th width="20%">Order</th>
                                    <th width="20%">Status</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($coupons)
                                    @foreach ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $coupon->category }}</td>
                                            <td>{{ $coupon->question }}</td>
                                            <td>{{ $coupon->order }}</td>
                                            <td> <span
                                                    class="badge {{ $coupon->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $coupon->status }}
                                                </span></td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#couponViewModal{{ $coupon->id }}"
                                                        class="text-info" aria-label="View Coupon">
                                                        <i class="ph-airplay"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#couponEditModal{{ $coupon->id }}"
                                                        class="text-primary mx-2" aria-label="Edit Coupon">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <div id="couponEditModal{{ $coupon->id }}" class="modal fade"
                                                        data-bs-keyboard="false" data-bs-backdrop="static"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Coupon</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-3">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Coupon
                                                                                        Code</label>
                                                                                    <input name="code" value="{{ $coupon->code }}" type="text"
                                                                                        class="form-control form-control-sm" placeholder="Enter Coupon Code"
                                                                                        maxlength="50">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Type</label>
                                                                                    <select class="form-control select" data-placeholder=" Select Type"
                                                                                        data-minimum-results-for-search="Infinity"
                                                                                        data-container-css-class="select-sm" name="type">
                                                                                        <option></option>
                                                                                        <option value="fixed" @selected($coupon->type == 'fixed')>Fixed</option>
                                                                                        <option value="percentage" @selected($coupon->type == 'percentage')>Percentage
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Max Uses</label>
                                                                                    <input id="max_uses" name="max_uses" value="{{ $coupon->max_uses }}"
                                                                                        type="text" class="form-control form-control-sm maxUsers"
                                                                                        placeholder="Enter Max Uses">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Valid From</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text"><i class="ph-calendar"></i></span>
                                                                                        <input type="date" class="form-control form-control-sm" name="valid_from"
                                                                                            value="{{ $coupon->valid_from }}" placeholder="Enter Valid From">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Valid
                                                                                        Until</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text"><i class="ph-calendar"></i></span>
                                                                                        <input type="date" class="form-control form-control-sm" name="valid_until"
                                                                                            value="{{ $coupon->valid_until }}" placeholder="Enter Valid Until">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Status</label>
                                                                                    <select class="form-control form-control-sm select" name="status"
                                                                                        data-minimum-results-for-search="Infinity"
                                                                                        data-container-css-class="select-sm">
                                                                                        <option value="active" @selected($coupon->status == 'active')>Active</option>
                                                                                        <option value="expired" @selected($coupon->status == 'expired')>Expired
                                                                                        </option>
                                                                                        <option value="used" @selected($coupon->status == 'used')>Used</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Description</label>
                                                                                    <input name="description" type="text" class="form-control form-control-sm"
                                                                                        placeholder="Enter Coupon Description" maxlength="255"
                                                                                        value="{{ $coupon->description }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary from-prevent-multiple-submits">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('coupon.destroy', $coupon->id) }}"
                                                        class="text-danger mx-2 delete" aria-label="Delete Coupon">
                                                        <i class="ph-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Disabled keyboard interaction add modal for coupon -->
                <div id="couponAddModal" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Coupon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('coupon.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-2">
                                                <label class="form-label">Coupon Code</label>
                                                <input name="code" value="" type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Coupon Code" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-2">
                                                <label class="form-label">Type</label>
                                                <select class="form-control select" data-placeholder=" Select Type"
                                                    data-minimum-results-for-search="Infinity" data-container-css-class="select-sm"
                                                    name="type">
                                                    <option></option>
                                                    <option value="fixed">Fixed</option>
                                                    <option value="percentage">Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-2">
                                                <label class="form-label">Max Uses</label>
                                                <input id="max_uses" name="max_uses" type="text"
                                                    class="form-control form-control-sm maxUsers" placeholder="Enter Max Uses">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-2">
                                                <label class="form-label">Valid From</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ph-calendar"></i></span>
                                                    <input type="date" class="form-control form-control-sm" name="valid_from"
                                                        value="03/18/2013" placeholder="Enter Valid From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-2">
                                                <label class="form-label">Valid Until</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="ph-calendar"></i></span>
                                                    <input type="date" class="form-control form-control-sm" name="valid_until"
                                                        value="03/18/2013" placeholder="Enter Valid Until">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-2">
                                                <label class="form-label">Status</label>
                                                <select class="form-control form-control-sm select" name="status"
                                                    data-minimum-results-for-search="Infinity" data-container-css-class="select-sm">
                                                    <option value="active">Active</option>
                                                    <option value="expired">Expired</option>
                                                    <option value="used">Used</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label class="form-label">Description</label>
                                                <input name="description" type="text" class="form-control form-control-sm"
                                                    placeholder="Enter Coupon Description" maxlength="255">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary from-prevent-multiple-submits">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach ($coupons as $coupon)
                    <div id="couponViewModal{{ $coupon->id }}" class="modal fade text-start"
                        data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary d-flex align-items-center">
                                        <span>{{ $coupon->category }} </span>
                                        <span class="badge bg-secondary ms-2">{{ $coupon->order ?? '0' }}</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5 class="text-info">{{ $coupon->question }}</h5>
                                            <p><span class="text-success fw-bold">Ans:</span> {{ $coupon->answer }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary from-prevent-multiple-submits">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('.data-table-coupon').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [5],
                }],
            });

            $(document).ready(function() {
                $('.select2-hidden-accessible').select2();
            });
        </script>
    @endpush
</x-admin-layout>
