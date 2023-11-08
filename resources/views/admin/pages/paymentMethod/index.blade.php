<x-admin-layout :title="'Payment Method - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#paymentMethodAddModal"
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
                            class="data-table-paymentMethod table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="45%">Name</th>
                                    <th width="45%">Slug</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($paymentMethods)
                                    @foreach ($paymentMethods as $paymentMethod)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $paymentMethod->name }}</td>
                                            <td>{{ $paymentMethod->slug }}</td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#paymentMethodEditModal{{ $paymentMethod->id }}"
                                                        class="text-primary" aria-label="Edit Category">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <div id="paymentMethodEditModal{{ $paymentMethod->id }}"
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
                                                                    action="{{ route('paymentMethod.update', $paymentMethod->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Payment
                                                                                        Method
                                                                                        Name</label>
                                                                                    <input id="name" name="name"
                                                                                        value="{{ $paymentMethod->name }}"
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
                                                    <a href="{{ route('paymentMethod.destroy', $paymentMethod->id) }}"
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

                <!-- Disabled keyboard interaction add modal for paymentMethod -->
                <div id="paymentMethodAddModal" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('paymentMethod.store') }}" method="POST">
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
            $('.data-table-paymentMethod').DataTable({
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
