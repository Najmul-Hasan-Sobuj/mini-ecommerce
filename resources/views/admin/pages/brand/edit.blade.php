<x-admin-layout :title="'Brand Edit - ' . config('app.name')">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Basic layout</h5>
        </div>

        <div class="card-body">
            Vertical form is the most common layout. Since Bootstrap applies <code>display: block</code> and
            <code>width: 100%</code> to almost all our form controls, forms will by default stack vertically. Additional
            classes can be used to vary this layout on a per-form basis. Also use <code>.form-label</code> class in
            labels to add bottom margin. Be sure to use an appropriate type attribute on all inputs (e.g.,
            <code>email</code> for email address or <code>number</code> for numerical information) to take advantage of
            newer input controls like email verification, number selection, and more.
        </div>

        <div class="card-body border-top">
            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Brand Name:</label>
                    <input type="text" name="name" value="{{ $brand->name }}" class="form-control"
                        placeholder="Enter Brand Name">
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand Logo:</label>
                    <input type="file" name="image" class="form-control">
                    <div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit form <i
                            class="ph-paper-plane-tilt ms-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script></script>
    @endpush
</x-admin-layout>
