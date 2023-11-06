<!DOCTYPE html>
<html lang="en" dir="ltr">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DADAVAAI') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Global stylesheets -->
    <link href="{{ asset('admin/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/toastr.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
</head>

<body>

    <!-- Main navbar -->
    @include('admin.partials.navigation')
    <!-- /main navbar -->

    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
            <!-- Sidebar content -->
            <div class="sidebar-content">

                <!-- Sidebar header -->
                @include('admin.partials.sidebar-header')

                <!-- /sidebar header -->

                <!-- Main navigation -->
                @include('admin.partials.main-navigation')

                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Page header -->
                @include('admin.partials.page-header')
                <!-- /page header -->

                <!-- Content area -->
                <div class="content">
                    {{ $slot }}
                </div>
                <!-- /content area -->

                <!-- Footer -->
                @include('admin.partials.footer')
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <!-- Core JS files -->
    {{-- <script src="{{ asset('admin/assets/demo/demo_configurator.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    {{-- <script src="{{ asset('admin/assets/js/vendor/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/visualization/d3/d3_tooltip.js') }}"></script> --}}
    <script src="{{ asset('admin/assets/js/jquery/jquery.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js" type="text/javascript"></script>
    <script src="https://codepen.io/grayghostvisuals/pen/a08e0d79c150ff5030f9b6afaa137749.js" type="text/javascript">
    </script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/js/vendor/uploaders/fileinput/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/uploaders/fileinput/fileinput.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/notifications/bootbox.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/notifications/noty.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/forms/tags/tokenfield.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/vendor/forms/inputs/imask.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/forms/inputs/autosize.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/forms/inputs/passy.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/forms/inputs/maxlength.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/vendor/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/pickers/datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/editors/ckeditor/ckeditor_classic.js') }}"></script>

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('admin/assets/demo/pages/extra_sweetalert.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/components_buttons.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/partials.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/form_select2.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/form_multiselect.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/components_modals.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/table_elements.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/datatables_basic.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/datatables_extension_buttons_init.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/datatables_extension_responsive.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/colors_secondary.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/form_tags.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/form_controls_extended.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/picker_date.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/editor_ckeditor_classic.js') }}"></script>

    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
    @stack('scripts')

    {{-- <script src="{{ asset('admin/assets/demo/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/streamgraph.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/sparklines.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/lines.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/areas.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/donuts.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/bars.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/progress.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/heatmaps.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/pies.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/charts/pages/dashboard/bullets.js') }}"></script> --}}
</body>

</html>
