<x-admin-layout :title="'Product Review Information - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table
                            class="data-table-product-review table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="15%">User Name</th>
                                    <th width="40%">Review Text</th>
                                    <th width="5%">Rating</th>
                                    <th width="10%">Verified</th>
                                    <th width="15%">Created At</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($productReviews)
                                    @foreach ($productReviews as $review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $review->user_name }}</td> <!-- Displaying User Name -->
                                            <td>{{ $review->review_text }}</td>
                                            <td>{{ $review->rating_value }}</td>
                                            <td>
                                                <select name="is_verified"
                                                    class="form-control form-control-sm select verification-selector"
                                                    data-id="{{ $review->id }}"
                                                    data-minimum-results-for-search="Infinity"
                                                    data-container-css-class="select-sm"
                                                    data-current-status="{{ $review->is_verified }}">
                                                    <option @selected($review->is_verified == 'yes') value="yes">Verified
                                                    </option>
                                                    <option @selected($review->is_verified == 'no') value="no">Not Verified
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ $review->created_at->format('F d, Y h:i A') }}</td>
                                            <td>
                                                <div class="d-inline-flex text-center">
                                                    <a href="{{ route('product.review.destroy', $review->id) }}"
                                                        class="text-danger delete">
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
            $('.data-table-product-review').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [4, 6],
                }],
            });

            $(document).ready(function() {
                $(document).on('change', '.verification-selector', function() {
                    var newStatus = $(this).val();
                    var currentStatus = $(this).data('current-status');
                    var reviewId = $(this).data('id');

                    if (newStatus != currentStatus) {
                        swalInit.fire({
                            title: 'Are you sure?',
                            text: 'Do you want to update the verification status?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, update it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/admin/update-review-status/' +
                                        reviewId,
                                    type: 'POST',
                                    data: {
                                        is_verified: newStatus,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        swalInit.fire('Updated!',
                                            'The verification status has been updated.',
                                            'success');
                                        $(this).data('current-status',
                                            newStatus);
                                    },
                                    error: function(xhr, status, error) {
                                        swalInit.fire('Error!',
                                            'There was a problem updating the status.',
                                            'error');
                                    }
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush

</x-admin-layout>
