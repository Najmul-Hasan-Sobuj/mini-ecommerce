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
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        max="255" value="{{ old('name') }}"
                                        placeholder="Enter Your Product Name">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Quantity </label>
                                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                        class="form-control form-control-sm @error('quantity') is-invalid @enderror"
                                        max="10000" min="1" placeholder="Enter Product Quantity">
                                    @error('quantity')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Product key:</label>
                                    <input type="text" name="sku" value="{{ old('sku') }}"
                                        class="form-control form-control-sm @error('sku') is-invalid @enderror"
                                        placeholder="Enter your product key" id="mask_product_key">
                                    @error('sku')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Size </label>
                                    <select name="sizes[]"
                                        class="form-control form-control-sm multiselect @error('sizes') is-invalid @enderror"
                                        multiple="multiple" data-include-select-all-option="true"
                                        data-button-class="btn btn-sm" data-enable-filtering="true"
                                        data-enable-case-insensitive-filtering="true">
                                        <option value="s" {{ in_array('s', old('sizes', [])) ? 'selected' : '' }}>S
                                        </option>
                                        <option value="m" {{ in_array('m', old('sizes', [])) ? 'selected' : '' }}>M
                                        </option>
                                        <option value="l" {{ in_array('l', old('sizes', [])) ? 'selected' : '' }}>
                                            L</option>
                                        <option value="xl"
                                            {{ in_array('xl', old('sizes', [])) ? 'selected' : '' }}>XL</option>
                                        <option value="xxl"
                                            {{ in_array('xxl', old('sizes', [])) ? 'selected' : '' }}>XXL</option>
                                        <option value="64gb"
                                            {{ in_array('64gb', old('sizes', [])) ? 'selected' : '' }}>64GB</option>
                                        <option value="128gb"
                                            {{ in_array('128gb', old('sizes', [])) ? 'selected' : '' }}>128GB</option>
                                        <option value="512gb"
                                            {{ in_array('512gb', old('sizes', [])) ? 'selected' : '' }}>512GB</option>
                                        <option value="1tb"
                                            {{ in_array('1tb', old('sizes', [])) ? 'selected' : '' }}>1TB</option>
                                    </select>
                                    @error('sizes')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Color </label>
                                    <select name="colors[]"
                                        class="form-control form-control-sm multiselect @error('colors') is-invalid @enderror"
                                        multiple="multiple" data-include-select-all-option="true"
                                        data-enable-filtering="true" data-button-class="btn btn-sm"
                                        data-enable-case-insensitive-filtering="true">
                                        <option @selected(in_array('white', old('colors', []))) value="white">White</option>
                                        <option @selected(in_array('yellow', old('colors', []))) value="yellow">Yellow</option>
                                        <option @selected(in_array('blue', old('colors', []))) value="blue">Blue</option>
                                        <option @selected(in_array('red', old('colors', []))) value="red">Red</option>
                                        <option @selected(in_array('green', old('colors', []))) value="green">Green</option>
                                        <option @selected(in_array('black', old('colors', []))) value="black">Black</option>
                                        <option @selected(in_array('brown', old('colors', []))) value="brown">Brown</option>
                                        <option @selected(in_array('azure', old('colors', []))) value="azure">Azure</option>
                                        <option @selected(in_array('ivory', old('colors', []))) value="ivory">Ivory</option>
                                        <option @selected(in_array('teal', old('colors', []))) value="teal">Teal</option>
                                        <option @selected(in_array('silver', old('colors', []))) value="silver">Silver</option>
                                        <option @selected(in_array('purple', old('colors', []))) value="purple">Purple</option>
                                        <option @selected(in_array('navy_blue', old('colors', []))) value="navy_blue">Navy blue</option>
                                        <option @selected(in_array('pea_green', old('colors', []))) value="pea_green">Pea green</option>
                                        <option @selected(in_array('gray', old('colors', []))) value="gray">Gray</option>
                                        <option @selected(in_array('orange', old('colors', []))) value="orange">Orange</option>
                                        <option @selected(in_array('maroon', old('colors', []))) value="maroon">Maroon</option>
                                        <option @selected(in_array('charcoal', old('colors', []))) value="charcoal">Charcoal</option>
                                        <option @selected(in_array('aquamarine', old('colors', []))) value="aquamarine">Aquamarine</option>
                                        <option @selected(in_array('coral', old('colors', []))) value="coral">Coral</option>
                                        <option @selected(in_array('fuchsia', old('colors', []))) value="fuchsia">Fuchsia</option>
                                        <option @selected(in_array('wheat', old('colors', []))) value="wheat">Wheat</option>
                                        <option @selected(in_array('lime', old('colors', []))) value="lime">Lime</option>
                                        <option @selected(in_array('crimson', old('colors', []))) value="crimson">Crimson</option>
                                        <option @selected(in_array('khaki', old('colors', []))) value="khaki">Khaki</option>
                                        <option @selected(in_array('hot_pink', old('colors', []))) value="hot_pink">Hot pink</option>
                                        <option @selected(in_array('magenta', old('colors', []))) value="magenta">Magenta</option>
                                        <option @selected(in_array('olden', old('colors', []))) value="olden">Olden</option>
                                        <option @selected(in_array('plum', old('colors', []))) value="plum">Plum</option>
                                        <option @selected(in_array('olive', old('colors', []))) value="olive">Olive</option>
                                        <option @selected(in_array('cyan', old('colors', []))) value="cyan">Cyan</option>
                                    </select>
                                    @error('colors')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-2">
                                    <label class="form-label">Brand Name <span class="text-danger">*</span></label>
                                    <select name="brand_id" id="brand_id" data-placeholder="Select Brand Name"
                                        class="form-control form-control-sm select @error('brand_id') is-invalid @enderror"
                                        data-container-css-class="select-sm">
                                        <option></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" id="price" name="price"
                                        value="{{ old('price') }}"
                                        class="form-control form-control-sm @error('price') is-invalid @enderror"
                                        max="1000000" min="1" placeholder="Enter Product price">
                                    @error('price')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-2">
                                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <select name="category_id" data-placeholder="Select Category Name"
                                        class="form-control form-control-sm category_dropdown select @error('category_id') is-invalid @enderror"
                                        data-container-css-class="select-sm">
                                        <option></option>
                                        @foreach ($categorys as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-2">
                                    <label class="form-label">Status</label>
                                    <select
                                        class="form-control form-control-sm select @error('status') is-invalid @enderror"
                                        data-placeholder="Select a Status" data-minimum-results-for-search="Infinity"
                                        data-container-css-class="select-sm" name="status" id="status">
                                        <option></option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            In Active</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label class="form-label">Product Tag</label>
                                    <select data-placeholder="Type and hit enter to add a tag"
                                        class="form-control form-control-sm select @error('tags') is-invalid @enderror"
                                        id="tags" name="tags[]" data-container-css-class="select-sm"
                                        multiple="multiple" data-tags="true" data-maximum-input-length="30">

                                        @if (old('tags'))
                                            @foreach (old('tags') as $tag)
                                                <option value="{{ $tag }}" selected>{{ $tag }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('tags')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-lg-3">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Image </label>
                                    <input type="file"
                                        class="form-control form-control-sm @error('image') is-invalid @enderror"
                                        accept="image/png, image/jpg, image/jpeg" name="image">
                                    <div class="form-text"><span class="text-muted">Accepts only png,jpeg,jpg
                                            types</span></div>
                                    @error('image')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Multiple Image </label>
                                    <input type="file"
                                        class="form-control form-control-sm @error('images') is-invalid @enderror"
                                        name="images[]" accept="image/png, image/jpg, image/jpeg" multiple>
                                    <div class="form-text"><span class="text-muted">Accepts only png, jpeg,jpg
                                            types</span></div>
                                    @error('images')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label class="col-form-label">Product Description</label>
                                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                                        id="ckeditor_classic_empty_1" name="description" placeholder="Enter your text...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
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
