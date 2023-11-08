<x-admin-layout :title="'Faq - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#faqAddModal"
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
                            class="data-table-faq table datatable-responsive table-bordered table-striped table-hover">
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
                                @if ($faqs)
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $faq->category }}</td>
                                            <td>{{ $faq->question }}</td>
                                            <td>{{ $faq->order }}</td>
                                            <td> <span
                                                    class="badge {{ $faq->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $faq->status }}
                                                </span></td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#faqViewModal{{ $faq->id }}"
                                                        class="text-info" aria-label="View Faq">
                                                        <i class="ph-airplay"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#faqEditModal{{ $faq->id }}"
                                                        class="text-primary mx-2" aria-label="Edit Faq">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <div id="faqEditModal{{ $faq->id }}" class="modal fade"
                                                        data-bs-keyboard="false" data-bs-backdrop="static"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Faq</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <form action="{{ route('faq.update', $faq->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-2">
                                                                                    <label class="form-label">Category
                                                                                        <span
                                                                                            class="text-danger">*</span></label>
                                                                                    <input name="category"
                                                                                        value="{{ $faq->category }}"
                                                                                        type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="Enter Category"
                                                                                        maxlength="100" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="mb-2">
                                                                                    <label
                                                                                        class="form-label ">Status</label>
                                                                                    <select name="status"
                                                                                        data-placeholder="Select a Status..."
                                                                                        class="form-control select"
                                                                                        data-minimum-results-for-search="Infinity">
                                                                                        <option></option>
                                                                                        <option
                                                                                            @selected($faq->status == 'active')
                                                                                            value="active">Active
                                                                                        </option>
                                                                                        <option
                                                                                            @selected($faq->status == 'inactive')
                                                                                            value="inactive">In Active
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2">
                                                                                <div class="mb-2">
                                                                                    <label
                                                                                        class="form-label">Order</label>
                                                                                    <input type="text"
                                                                                        class="form-control form-control-sm integerInput"
                                                                                        placeholder="E.g: 100"
                                                                                        id="order" name="order"
                                                                                        value="{{ $faq->order }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-2">
                                                                                    <label
                                                                                        class="form-label">Question</label>
                                                                                    <input id="question"
                                                                                        name="question"
                                                                                        value="{{ $faq->question }}"
                                                                                        type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="Do You Have Question ?"
                                                                                        maxlength="100" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="mb-2">
                                                                                    <label
                                                                                        class="form-label">Answer</label>
                                                                                    <textarea class="form-control form-control-sm" id="answer" name="answer" placeholder="Yes I Have.">{{ $faq->answer }}</textarea>
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
                                                    <a href="{{ route('faq.destroy', $faq->id) }}"
                                                        class="text-danger mx-2 delete" aria-label="Delete Faq">
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

                <!-- Disabled keyboard interaction add modal for faq -->
                <div id="faqAddModal" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Faq</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('faq.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label class="form-label">Category <span
                                                        class="text-danger">*</span></label>
                                                <input name="category" type="text"
                                                    class="form-control form-control-sm" placeholder="Enter Category"
                                                    maxlength="100" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-2">
                                                <label class="form-label ">Status</label>
                                                <select name="status" data-placeholder="Select a Status..."
                                                    class="form-control select"
                                                    data-minimum-results-for-search="Infinity">
                                                    <option></option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">In Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-2">
                                                <label class="form-label">Order</label>
                                                <input type="text"
                                                    class="form-control form-control-sm integerInput"
                                                    placeholder="E.g: 100" id="order" name="order">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label class="form-label">Question</label>
                                                <input id="question" name="question" type="text"
                                                    class="form-control form-control-sm"
                                                    placeholder="Do You Have Question ?" maxlength="100" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label class="form-label">Answer</label>
                                                <textarea class="form-control form-control-sm" id="answer" name="answer" placeholder="Yes I Have."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach ($faqs as $faq)
                    <div id="faqViewModal{{ $faq->id }}" class="modal fade text-start" data-bs-keyboard="false"
                        data-bs-backdrop="static" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary d-flex align-items-center">
                                        <span>{{ $faq->category }} </span>
                                        <span class="badge bg-secondary ms-2">{{ $faq->order ?? '0' }}</span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5 class="text-info">{{ $faq->question }}</h5>
                                            <p><span class="text-success fw-bold">Ans:</span> {{ $faq->answer }}
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
            $('.data-table-faq').DataTable({
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
