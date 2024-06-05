<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <title>Absence & Signature</title>
    <link rel="manifest" href="/manifest.json">
    <link href="{{ asset('') }}css/styles.css" rel="stylesheet" />
    <link href="{{ asset('') }}css/custom.css" rel="stylesheet" />
    <!-- TODO : Resolve this datatable css, still on CDN -->
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- TODO : Cannot save inti local project cz some image stored in cloud -->
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('') }}assets/jqueryconfirm/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/jquerysignature/jquery.signature.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Base Project">
    <meta name="msapplication-TileImage" content="images/hello-icon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <script src="{{asset('')}}assets/fontawesome/font-awesome-5.15.1-all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('')}}assets/jquery/jquery-1.12.4.min.js"></script> 
    <script type="text/javascript" src="{{asset('')}}assets/plugins/jquery-ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('') }}assets/jqueryconfirm/jquery-confirm.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/moment/moment.min.js"> </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    @yield('custom-css')

</head>
<body class="sb-nav-fixed">
        @include('layout.header')
        @include('layout.sidebar')

        @yield('content')

        @include('layout.footer')


