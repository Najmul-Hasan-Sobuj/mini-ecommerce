<x-admin-layout :title="'Payment Transactions - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#paymentTransactionAddModal"
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
                            class="data-table-paymentTransaction table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="45%">Name</th>
                                    <th width="45%">Slug</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($paymentTransactions)
                                    @foreach ($paymentTransactions as $paymentTransaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $paymentTransaction->name }}</td>
                                            <td>{{ $paymentTransaction->slug }}</td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#paymentTransactionEditModal{{ $paymentTransaction->id }}"
                                                        class="text-primary" aria-label="Edit Category">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <div id="paymentTransactionEditModal{{ $paymentTransaction->id }}"
                                                        class="modal fade" data-bs-keyboard="false"
                                                        data-bs-backdrop="static" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Category</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <form
                                                                    action="{{ route('paymentTransaction.update', $paymentTransaction->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Order ID</label>
                                                                                    <input id="order_id" name="order_id"
                                                                                        value="{{ $paymentTransaction->order_id }}"
                                                                                        type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="Enter Payment Method Name">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Parent Category Name</label>
                                                                                    <select name="parent_id" data-placeholder="Select a Parent category..."
                                                                                        class="form-control form-control-sm select select-parent-category-add"
                                                                                        data-container-css-class="select-sm">
                                                                                        <option></option>
                                                                                        @foreach ($paymentMethods as $categorie)
                                                                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Payment
                                                                                        Method
                                                                                        Name</label>
                                                                                    <input id="name" name="name"
                                                                                        value="{{ $paymentTransaction->name }}"
                                                                                        type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="Enter Payment Method Name">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-link"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary ">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('paymentTransaction.destroy', $paymentTransaction->id) }}"
                                                        class="text-danger mx-2 delete" aria-label="Delete Category">
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

                <!-- Disabled keyboard interaction add modal for paymentTransaction -->
                <div id="paymentTransactionAddModal" class="modal fade" data-bs-keyboard="false"
                    data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('paymentTransaction.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Payment Method Name</label>
                                                <input id="name" name="name" type="text"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Payment Method Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('.data-table-paymentTransaction').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [3],
                }],
            });
        </script>
    @endpush
</x-admin-layout>
