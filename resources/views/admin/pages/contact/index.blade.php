<x-admin-layout :title="'Contact Information - ' . config('app.name')">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table
                            class="data-table-contact table datatable-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-secondary border-secondary text-white">
                                    <th width="5%">#</th>
                                    <th width="15%">Email</th>
                                    <th width="30%">Message</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Switch</th>
                                    <th width="30%">created_at</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($contacts)
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->msg }}</td>
                                            <td> <span
                                                    class="badge {{ $contact->is_banned == '1' ? 'bg-danger' : 'bg-success' }}">{{ $contact->is_banned == '1' ? 'Banned' : 'Not Banned' }}</span>
                                            </td>
                                            <td>
                                                <select name="is_banned"
                                                    class="form-control form-control-sm select status-selector banned-status-selector"
                                                    data-id="{{ $contact->id }}"
                                                    data-minimum-results-for-search="Infinity"
                                                    data-container-css-class="select-sm"
                                                    data-current-status="{{ $contact->is_banned }}">
                                                    <option @selected($contact->is_banned == '0') value="0">Not Banned
                                                    </option>
                                                    <option @selected($contact->is_banned == '1') value="1">Banned
                                                    </option>
                                                </select>
                                                </select>
                                            </td>
                                            <td>{{ $contact->created_at->format('F d, Y h:i A') }}</td>
                                            <td>
                                                <div class="d-inline-flex text-center">
                                                    <a href="{{ route('contact.destroy', $contact->id) }}"
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
            $('.data-table-contact').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [1, 2, 4, 6],
                }],
            });

            $(document).ready(function() {
                $(document).on('change', '.banned-status-selector', function() {
                    var newStatus = $(this).val();
                    var currentStatus = $(this).data('current-status');
                    var contactId = $(this).data('id');

                    if (newStatus != currentStatus) {
                        swalInit.fire({
                            title: 'Are you sure?',
                            text: 'Do you want to update the banned status?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, update it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/admin/update-contact-status/' +
                                        contactId, // Updated URL path
                                    type: 'POST',
                                    data: {
                                        is_banned: newStatus,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        swalInit.fire('Updated!',
                                            'The banned status has been updated.',
                                            'success');
                                        $(this).data('current-status', newStatus);
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
