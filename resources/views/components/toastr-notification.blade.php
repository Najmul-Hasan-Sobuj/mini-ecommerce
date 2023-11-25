<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success.message') }}',
        });
    @endif

    @if (session('error'))
        var errorMessage = @json(session('error'));
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            html: errorMessage.join('<br>'),
        });
    @endif
</script>
