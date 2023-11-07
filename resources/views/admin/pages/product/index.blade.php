<x-admin-layout :title="'Product Information - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex justify-content-end">
                    <div class="mb-2">
                        <a href="{{ route('product.create') }}"
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
                            class="data-table-product table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="5%">Thubmnail</th>
                                    <th width="20%">Name</th>
                                    <th width="5%">Code</th>
                                    <th width="5%">Price</th>
                                    <th width="5%">Quantity</th>
                                    <th width="5%">Status</th>
                                    <th width="10%">Sizes</th>
                                    <th width="10%">Colors</th>
                                    <th width="15%">Tags</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ isset($product->image) && Str::startsWith($product->image, 'https:') ? $product->image : (isset($product->image) ? asset('storage/' . $product->image) : asset('storage/main/noImage.jpg')) }}"
                                                    data-bs-popup="lightbox">
                                                    <img src="{{ isset($product->image) && Str::startsWith($product->image, 'https:') ? $product->image : (isset($product->image) ? asset('storage/' . $product->image) : asset('storage/main/noImage.jpg')) }}"
                                                        alt="{{ $product->slug }}" loading="lazy" class="img-preview"
                                                        width="25px" height="25px">
                                                </a>
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                <span class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $product->status }}
                                                </span>
                                            </td>
                                            <td>
                                                @if (!empty(($sizes = json_decode($product->sizes))))
                                                    @foreach ($sizes as $size)
                                                        <span class="badge bg-primary">{{ $size }}</span>
                                                    @endforeach
                                                @else
                                                    Data not available
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty(($colors = json_decode($product->colors))))
                                                    @foreach ($colors as $color)
                                                        <span class="badge bg-primary">{{ $color }}</span>
                                                    @endforeach
                                                @else
                                                    Data not available
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty(($tags = json_decode($product->tags))))
                                                    @foreach ($tags as $tag)
                                                        <span class="badge bg-primary">{{ $tag }}</span>
                                                    @endforeach
                                                @else
                                                    Data not available
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-inline-flex text-center">
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                        class="text-primary">
                                                        <i class="ph-pen"></i>
                                                    </a>
                                                    <a href="{{ route('product.destroy', $product->id) }}"
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
            $('.data-table-product').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [1, 3, 7, 8, 9, 10],
                }],
            });
        </script>
    @endpush
</x-admin-layout>
