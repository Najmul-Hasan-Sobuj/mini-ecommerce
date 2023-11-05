<div>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        @if ($message)
            switch ("{{ $alertType }}") {
                case 'info':
                    toastr.info("{{ $message }}");
                    break;
                case 'warning':
                    toastr.warning("{{ $message }}");
                    break;
                case 'success':
                    toastr.success("{{ $message }}");
                    break;
                case 'error':
                    toastr.error("{{ $message }}");
                    break;
            }
        @endif
    </script>

</div>
