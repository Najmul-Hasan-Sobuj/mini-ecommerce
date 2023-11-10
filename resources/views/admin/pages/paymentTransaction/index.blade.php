<x-admin-layout :title="'Payment Transaction Information - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table
                            class="data-table-paymentTransaction table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="20%">payment_method_id</th>
                                    <th width="15%">amount</th>
                                    <th width="20%">transaction_id</th>
                                    <th width="15%">status</th>
                                    <th width="20%">created_at</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($paymentTransactions)
                                    @foreach ($paymentTransactions as $paymentTransaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $paymentTransaction->paymentMethodName() }}</td>
                                            <td>{{ $paymentTransaction->amount }}</td>
                                            <td>{{ $paymentTransaction->transaction_id }}</td>
                                            <td>
                                                <select name="status"
                                                    class="form-control form-control-select2 status-selector"
                                                    data-id="{{ $paymentTransaction->id }}"
                                                    data-current-status="{{ $paymentTransaction->status }}">
                                                    <option @selected($paymentTransaction->status == 'pending') value="pending">Pending
                                                    </option>
                                                    <option @selected($paymentTransaction->status == 'completed') value="completed">Completed
                                                    </option>
                                                    <option @selected($paymentTransaction->status == 'failed') value="failed">Failed</option>
                                                    <option @selected($paymentTransaction->status == 'refunded') value="refunded">Refunded
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ $paymentTransaction->created_at }}</td>
                                            <td>
                                                <div class="d-inline-flex text-center">
                                                    <a href="{{ route('payment.transaction.destroy', $paymentTransaction->id) }}"
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
            $('.data-table-paymentTransaction').DataTable({
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
                $(document).on('change', '.status-selector', function() {
                    var selectedStatus = $(this).val();
                    var currentStatus = $(this).data('current-status');
                    var transactionId = $(this).data('id');

                    if (selectedStatus !== currentStatus) {
                        swalInit.fire({
                            title: 'Are you sure?',
                            text: 'Do you want to update the status?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, update it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/admin/update-transaction-status/' +
                                        transactionId,
                                    type: 'POST',
                                    data: {
                                        status: selectedStatus,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        swalInit.fire('Updated!',
                                            'The status has been updated.', 'success');
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
