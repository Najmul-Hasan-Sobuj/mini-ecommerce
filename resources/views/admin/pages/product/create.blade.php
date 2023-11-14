<x-admin-layout :title="'Product Create - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <!-- Product Create Form Start -->
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card border border-secondary px-0 rounded-0">
                    <div class="card-header bg-secondary text-white rounded-0 p-2">
                        <h6 class="mb-0 text-center">Product Info Add</h6>
                    </div>
                    <div class="card-body border-secondary">
                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="mb-2">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-sm " max="200"
                                        placeholder="Enter Your Product Name" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Quantity </label>
                                    <input type="number" id="quantity" name="quantity"
                                        class="form-control form-control-sm " max="1000" min="1"
                                        placeholder="Enter Product Quantity">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Product key:</label>
                                    <input type="text" name="sku" class="form-control form-control-sm"
                                        placeholder="Enter your product key" id="mask_product_key">
                                    <span class="form-text">a*-000-a000</span>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Size </label>
                                    <select name="sizes[]" class="form-control form-control-sm multiselect"
                                        multiple="multiple" data-include-select-all-option="true"
                                        data-button-class="btn btn-sm" data-enable-filtering="true"
                                        data-enable-case-insensitive-filtering="true">
                                        <option value="s">S</option>
                                        <option value="m">M</option>
                                        <option value="l">L</option>
                                        <option value="xl">XL</option>
                                        <option value="xxl">XXL</option>
                                        <option value="64gb">64GB</option>
                                        <option value="128gb">128GB</option>
                                        <option value="512gb">512GB</option>
                                        <option value="1tb">1TB</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Color </label>
                                    <select name="colors[]" class="form-control form-control-sm multiselect"
                                        multiple="multiple" data-include-select-all-option="true"
                                        data-enable-filtering="true" data-button-class="btn btn-sm"
                                        data-enable-case-insensitive-filtering="true">
                                        <option value="white">White</option>
                                        <option value="yellow">Yellow</option>
                                        <option value="blue">Blue</option>
                                        <option value="red">Red</option>
                                        <option value="green">Green</option>
                                        <option value="black">Black</option>
                                        <option value="brown">Brown</option>
                                        <option value="azure">Azure</option>
                                        <option value="ivory">Ivory</option>
                                        <option value="teal">Teal</option>
                                        <option value="silver">Silver</option>
                                        <option value="purple">Purple</option>
                                        <option value="navy_blue">Navy blue</option>
                                        <option value="pea_green">Pea green</option>
                                        <option value="gray">Gray</option>
                                        <option value="orange">Orange</option>
                                        <option value="maroon">Maroon</option>
                                        <option value="charcoal">Charcoal</option>
                                        <option value="aquamarine">Aquamarine</option>
                                        <option value="coral">Coral</option>
                                        <option value="fuchsia">Fuchsia</option>
                                        <option value="wheat">Wheat</option>
                                        <option value="lime">Lime</option>
                                        <option value="crimson">Crimson</option>
                                        <option value="khaki">Khaki</option>
                                        <option value="hot_pink">Hot pink</option>
                                        <option value="magenta">Magenta</option>
                                        <option value="olden">Olden</option>
                                        <option value="plum">Plum</option>
                                        <option value="olive">Olive</option>
                                        <option value="cyan">Cyan</option>
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
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" id="price" name="price"
                                        class="form-control form-control-sm " max="1000000" min="1"
                                        placeholder="Enter Product price">
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="active">Active</option>
                                        <option value="inactive">In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label class="form-label">Product Tag</label>
                                    <select data-placeholder="Type and hit enter to add a tag"
                                        class="form-control form-control-sm select" id="tags" name="tags[]"
                                        data-container-css-class="select-sm" multiple="multiple" data-tags="true"
                                        data-maximum-input-length="30">
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
                                    <div class="form-text"><span class="text-muted">Accepts only png, jpeg,
                                            jpg
                                            types</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Description </label>
                                    <textarea class="form-control form-control-sm" id="ckeditor_classic_empty_1" name="description"
                                        placeholder="Enter your text..."></textarea>
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
