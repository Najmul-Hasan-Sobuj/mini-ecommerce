<x-admin-layout :title="'Refund Policy - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <!-- Refund Policy Create Form Start -->
            <form action="{{ route('refund.policy.update.or.create') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card border border-secondary px-0 rounded-0">
                    <div class="card-header bg-secondary text-white rounded-0 p-2">
                        <h6 class="mb-0 text-center">Refund Policy</h6>
                    </div>
                    <div class="card-body border-secondary">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <textarea class="form-control form-control-sm" id="ckeditor_classic_empty_1" name="policy_text"
                                        placeholder="Enter your text...">{!! optional($refundPolicies)->policy_text !!}</textarea>
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
        <!-- Refund Policy Create Form End -->
    </div>

    @push('scripts')
    @endpush
</x-admin-layout>
