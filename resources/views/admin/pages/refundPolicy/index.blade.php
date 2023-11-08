<x-admin-layout :title="'Refund Policy - ' . config('app.name')">



    @push('scripts')
        {{-- <script>
            $('.data-table-paymentTransaction').DataTable({
                dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                autoWidth: false,
                responsive: true,
                "iDisplayLength": 10,
                "lengthMenu": [10, 25, 30, 50],
                columnDefs: [{
                    orderable: false,
                    width: 100,
                    targets: [3],
                }],
            });
        </script> --}}
    @endpush
</x-admin-layout>
