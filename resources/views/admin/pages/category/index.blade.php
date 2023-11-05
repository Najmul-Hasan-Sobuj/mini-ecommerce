<x-admin-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot> --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#categoryAddModal"
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
                            class="data-table-category table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="90%">Name</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="d-inline-flex">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#categoryEditModal{{ $category->id }}"
                                                        class="text-primary" aria-label="Edit Category">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <div id="categoryEditModal{{ $category->id }}" class="modal fade"
                                                        data-bs-keyboard="false" data-bs-backdrop="static"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Category</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <form
                                                                    action="{{ route('category.update', $category->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Category
                                                                                        Name</label>
                                                                                    <select name="category_id"
                                                                                        data-placeholder="Select a category..."
                                                                                        class="form-control form-control-sm select select-category-edit"
                                                                                        data-container-css-class="select-sm">
                                                                                        <option></option>
                                                                                        @foreach ($categories as $categorie)
                                                                                            <option
                                                                                                value="{{ $categorie->id }}"
                                                                                                @selected($categorie->id == $category->category_id)>
                                                                                                {{ $categorie->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-8">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Category
                                                                                        Name</label>
                                                                                    <input id="name" name="name"
                                                                                        value="{{ $category->name }}"
                                                                                        type="text"
                                                                                        class="form-control form-control-sm"
                                                                                        placeholder="Enter Category Name"
                                                                                        maxlength="200">
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
                                                    <a href="{{ route('category.destroy', $category->id) }}"
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

                <!-- Disabled keyboard interaction add modal for category -->
                <div id="categoryAddModal" class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('category.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Category Name</label>
                                                <select name="category_id" data-placeholder="Select a category..."
                                                    class="form-control form-control-sm select select-category-add"
                                                    data-container-css-class="select-sm">
                                                    <option></option>
                                                    @foreach ($categories as $categorie)
                                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label class="form-label">Category Name</label>
                                                <input id="name" name="name" type="text"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter Category Name" maxlength="200">
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
                <!-- Disabled keyboard interaction add modal for category -->

                @push('scripts')
                    <script>
                        $('#categoryAddModal').on('shown.bs.modal', function() {
                            $('.select-category-add').select2({
                                dropdownParent: $('#categoryAddModal')
                            })
                        });

                        $('#categoryEditModal').on('shown.bs.modal', function() {
                            $('.select-category-edit').select2({
                                dropdownParent: $('#categoryEditModal')
                            })
                        });

                        $('.data-table-category').DataTable({
                            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                            autoWidth: false,
                            responsive: true,
                            "iDisplayLength": 10,
                            "lengthMenu": [10, 25, 30, 50],
                            columnDefs: [{
                                orderable: false,
                                width: 100,
                                targets: [2],
                            }, ],
                        });
                    </script>
                @endpush

            </div>
        </div>
    </div>
</x-admin-layout>