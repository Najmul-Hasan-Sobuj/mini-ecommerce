<x-admin-layout :title="'Product Edit - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <!-- Product Edit Form Start -->
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card border border-secondary px-0 rounded-0">
                    <div class="card-header bg-secondary text-white rounded-0 p-2">
                        <h6 class="mb-0 text-center">Product Info Add</h6>
                    </div>
                    <div class="card-body border-secondary">
                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="mb-2">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name" value="{{ $product->name }}"
                                        class="form-control form-control-sm maxlength-options" maxlength="200"
                                        placeholder="Enter Your Product Name" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Quantity </label>
                                    <input type="number" id="quantity" name="quantity"
                                        value="{{ $product->quantity }}"
                                        class="form-control form-control-sm maxlength-options" max="1000"
                                        min="1" placeholder="Enter Product Quantity">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Product key:</label>
                                    <input type="text" name="sku" value="{{ $product->sku }}"
                                        class="form-control" placeholder="Enter your product key" id="mask_product_key">
                                    <span class="form-text">a*-000-a000</span>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-2">
                                    @php
                                        $productSizes = is_array($product->sizes) ? $product->sizes : json_decode($product->sizes, true);
                                    @endphp
                                    <label class="form-label">Size </label>
                                    <select name="sizes[]" class="form-control form-control-sm multiselect"
                                        multiple="multiple" data-include-select-all-option="true"
                                        data-button-class="btn btn-sm" data-enable-filtering="true"
                                        data-enable-case-insensitive-filtering="true">
                                        <option @selected(!is_null($productSizes) && in_array('1', $productSizes)) value="1">S</option>
                                        <option @selected(!is_null($productSizes) && in_array('2', $productSizes)) value="2">M</option>
                                        <option @selected(!is_null($productSizes) && in_array('3', $productSizes)) value="3">L</option>
                                        <option @selected(!is_null($productSizes) && in_array('4', $productSizes)) value="4">XL</option>
                                        <option @selected(!is_null($productSizes) && in_array('5', $productSizes)) value="5">XXL</option>
                                        <option @selected(!is_null($productSizes) && in_array('6', $productSizes)) value="6">64GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('7', $productSizes)) value="7">128GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('8', $productSizes)) value="8">512GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('9', $productSizes)) value="9">1TB</option>
                                        <option @selected(!is_null($productSizes) && in_array('10', $productSizes)) value="10">3/32 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('11', $productSizes)) value="11">4/64 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('12', $productSizes)) value="12">4/128 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('13', $productSizes)) value="13">6/128 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('14', $productSizes)) value="14">8/128 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('15', $productSizes)) value="15">8/256 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('16', $productSizes)) value="16">12/256 GB</option>
                                        <option @selected(!is_null($productSizes) && in_array('17', $productSizes)) value="17">12/512 GB</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-2">
                                @php
                                    $productColors = is_array($product->colors) ? $product->colors : (isset($product->colors) ? json_decode($product->colors, true) : []);
                                @endphp
                                <div class="mb-2">
                                    <label class="form-label">Color </label>
                                    <select name="colors[]" class="form-control form-control-sm multiselect"
                                        multiple="multiple" data-include-select-all-option="true"
                                        data-enable-filtering="true" data-button-class="btn btn-sm"
                                        data-enable-case-insensitive-filtering="true">
                                        <option @selected(!is_null($productColors) && in_array('white', $productColors)) value="white">White</option>
                                        <option @selected(!is_null($productColors) && in_array('yellow', $productColors)) value="yellow">Yellow</option>
                                        <option @selected(!is_null($productColors) && in_array('blue', $productColors)) value="blue">Blue</option>
                                        <option @selected(!is_null($productColors) && in_array('red', $productColors)) value="red">Red</option>
                                        <option @selected(!is_null($productColors) && in_array('green', $productColors)) value="green">Green</option>
                                        <option @selected(!is_null($productColors) && in_array('black', $productColors)) value="black">Black</option>
                                        <option @selected(!is_null($productColors) && in_array('brown', $productColors)) value="brown">Brown</option>
                                        <option @selected(!is_null($productColors) && in_array('azure', $productColors)) value="azure">Azure</option>
                                        <option @selected(!is_null($productColors) && in_array('ivory', $productColors)) value="ivory">Ivory</option>
                                        <option @selected(!is_null($productColors) && in_array('teal', $productColors)) value="teal">Teal</option>
                                        <option @selected(!is_null($productColors) && in_array('silver', $productColors)) value="silver">Silver</option>
                                        <option @selected(!is_null($productColors) && in_array('purple', $productColors)) value="purple">Purple</option>
                                        <option @selected(!is_null($productColors) && in_array('navy_blue', $productColors)) value="navy_blue">Navy blue</option>
                                        <option @selected(!is_null($productColors) && in_array('pea_green', $productColors)) value="pea_green">Pea green</option>
                                        <option @selected(!is_null($productColors) && in_array('gray', $productColors)) value="gray">Gray</option>
                                        <option @selected(!is_null($productColors) && in_array('orange', $productColors)) value="orange">Orange</option>
                                        <option @selected(!is_null($productColors) && in_array('maroon', $productColors)) value="maroon">Maroon</option>
                                        <option @selected(!is_null($productColors) && in_array('charcoal', $productColors)) value="charcoal">Charcoal</option>
                                        <option @selected(!is_null($productColors) && in_array('aquamarine', $productColors)) value="aquamarine">Aquamarine</option>
                                        <option @selected(!is_null($productColors) && in_array('coral', $productColors)) value="coral">Coral</option>
                                        <option @selected(!is_null($productColors) && in_array('fuchsia', $productColors)) value="fuchsia">Fuchsia</option>
                                        <option @selected(!is_null($productColors) && in_array('wheat', $productColors)) value="wheat">Wheat</option>
                                        <option @selected(!is_null($productColors) && in_array('lime', $productColors)) value="lime">Lime</option>
                                        <option @selected(!is_null($productColors) && in_array('crimson', $productColors)) value="crimson">Crimson</option>
                                        <option @selected(!is_null($productColors) && in_array('khaki', $productColors)) value="khaki">Khaki</option>
                                        <option @selected(!is_null($productColors) && in_array('hot_pink', $productColors)) value="hot_pink">Hot pink</option>
                                        <option @selected(!is_null($productColors) && in_array('magenta', $productColors)) value="magenta">Magenta</option>
                                        <option @selected(!is_null($productColors) && in_array('olden', $productColors)) value="olden">Olden</option>
                                        <option @selected(!is_null($productColors) && in_array('plum', $productColors)) value="plum">Plum</option>
                                        <option @selected(!is_null($productColors) && in_array('olive', $productColors)) value="olive">Olive</option>
                                        <option @selected(!is_null($productColors) && in_array('cyan', $productColors)) value="cyan">Cyan</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-2">
                                    <label class="form-label">Brand Name <span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brand_id" data-placeholder="Select Brand Name"
                                        class="form-control form-control-sm select"
                                        data-container-css-class="select-sm">
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option @selected($brand->id == $product->brand_id) value="{{ $brand->id }}">
                                                {{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" id="price" name="price"
                                        value="{{ $product->price }}"
                                        class="form-control form-control-sm maxlength-options" max="1000000"
                                        min="1" placeholder="Enter Product price">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-2">
                                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <select name="category_id" data-placeholder="Select Category Name"
                                        class="form-control form-control-sm category_dropdown select"
                                        data-container-css-class="select-sm" required>
                                        <option></option>
                                        @foreach ($categorys as $category)
                                            <option @selected($category->id == $product->category_id) value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Status</label>
                                    <select class="form-control form-control-sm select"
                                        data-placeholder="Select a Status" data-minimum-results-for-search="Infinity"
                                        data-container-css-class="select-sm" name="status" id="status">
                                        <option></option>
                                        <option @selected($product->status == 'active') value="active">Active</option>
                                        <option @selected($product->status == 'inactive') value="inactive">In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label class="form-label">Product Tag</label>
                                    @php
                                        $meta_tag = is_array($product->tags) ? $product->tags : (isset($product->tags) ? json_decode($product->tags, true) : []);
                                    @endphp
                                    <select data-placeholder="Type and hit enter to add a tag"
                                        class="form-control form-control-sm select" id="tags" name="tags[]"
                                        data-container-css-class="select-sm" multiple="multiple" data-tags="true"
                                        data-maximum-input-length="30">
                                        @if ($meta_tag)
                                            @foreach ($meta_tag as $tag)
                                                <option @selected(in_array($tag, $meta_tag)) value="{{ $tag }}">
                                                    {{ $tag }}</option>
                                            @endforeach
                                        @else
                                            <option value=""></option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Image </label>
                                    <input type="file" class="form-control form-control-sm" name="image">
                                    <div class="form-text"><span class="text-muted">Accepts only png,jpeg,jpg
                                            types</span></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Multiple Image </label>
                                    <input type="file" class="form-control form-control-sm" name="images[]"
                                        multiple>
                                    <div class="form-text"><span class="text-muted">Accepts only png, jpeg, jpg
                                            types</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Description </label>
                                    <textarea class="form-control form-control-sm" id="ckeditor_classic_empty_1" name="description"
                                        placeholder="Enter your text...">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Submit Button Start-->
                <div class="text-end">
                    <button type="reset" class="btn btn-danger">Reset<i class="icon-reset"></i></button>
                    <button type="submit" class="btn btn-primary">Submit
                        <i class="ph-paper-plane-tilt ms-2"></i>
                    </button>
                </div>
                <!-- Form Submit Button End-->
            </form>
        </div>
        <!-- Product Create Form End -->
    </div>
    @push('scripts')
        <script></script>
    @endpush
</x-admin-layout>
