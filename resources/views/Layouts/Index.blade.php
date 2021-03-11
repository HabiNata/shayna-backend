<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Style --}}
    @stack('before-style')
    @include('Includes.Style')
    @stack('after-style')

</head>

<body>
    {{-- Sidebar --}}
    @include('Includes.Sidebar')

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        {{-- Navbar --}}
        @include('Includes.Navbar')

        <!-- Content -->
        <div class="content">

            {{-- content --}}
            @yield('content')

        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

        {{-- Footer --}}
        @include('Includes.Footer')

    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    {{-- meload script dari tempat lain sebelum script utama --}}
    @stack('before-script')

    @include('Includes.Script')

    {{-- meload script dari tempat lain setelah script utama --}}
    @stack('after-script')

</body>

</html>
