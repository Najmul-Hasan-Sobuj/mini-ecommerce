<x-admin-layout :title="'Brand Information - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <a href="{{ route('brand.create') }}"
                            class="btn btn-flat-success btn-labeled btn-labeled-start btn-sm">
                            <span class="btn-labeled-icon bg-success text-white">
                                <i class="ph-plus-circle ph-sm"></i>
                            </span>
                            Add
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table
                            class="data-table-brand table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="5%">Logo</th>
                                    <th width="85%">Name</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($brands)
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ isset($brand->image) && Str::startsWith($brand->image, 'https:') ? $brand->image : (isset($brand->image) ? asset('storage/' . $brand->image) : asset('storage/main/noImage.jpg')) }}"
                                                    data-bs-popup="lightbox">
                                                    <img src="{{ isset($brand->image) && Str::startsWith($brand->image, 'https:') ? $brand->image : (isset($brand->image) ? asset('storage/' . $brand->image) : asset('storage/main/noImage.jpg')) }}"
                                                        alt="{{ $brand->slug }}" loading="lazy" class="img-preview"
                                                        width="25px" height="25px">
                                                </a>
                                            </td>
                                            <td>{{ $brand->name }}</td>
                                            <td>
                                                <div class="d-inline-flex text-center">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#brandDetailsModal_{{ $brand->id }}"
                                                        class="text-primary" aria-label="Details Brand">
                                                        <i class="ph-airplay"></i>
                                                    </a>

                                                    <div id="brandDetailsModal_{{ $brand->id }}" class="modal fade"
                                                        data-bs-keyboard="false" data-bs-backdrop="static"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Brand Details</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Brand Name:</th>
                                                                                <td>{{ $brand->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Brand Logo:</th>
                                                                                <td> <a href="{{ isset($brand->image) && Str::startsWith($brand->image, 'https:') ? $brand->image : (isset($brand->image) ? asset('storage/requestImg/' . $brand->image) : asset('storage/main/noImage.jpg')) }}"
                                                                                        data-bs-popup="lightbox">
                                                                                        <img src="{{ isset($brand->image) && Str::startsWith($brand->image, 'https:') ? $brand->image : (isset($brand->image) ? asset('storage/requestImg/' . $brand->image) : asset('storage/main/noImage.jpg')) }}"
                                                                                            alt=""
                                                                                            loading="lazy"
                                                                                            class="img-preview rounded">
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('brand.edit', $brand->id) }}"
                                                        class="text-primary mx-2">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <a href="{{ route('brand.destroy', $brand->id) }}"
                                                        class="text-danger mx-2 delete">
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
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('.data-table-brand').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [1, 3],
                }],
            });
        </script>
    @endpush
</x-admin-layout>
