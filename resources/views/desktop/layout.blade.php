<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//cdn.muicss.com/mui-0.10.0/css/mui.min.css" rel="stylesheet" type="text/css"/>
    <link href="/css/app.css" rel="stylesheet" type="text/css"/>
    <script src="//cdn.muicss.com/mui-0.10.0/js/mui.min.js"></script>
    @yield('head-container')

</head>
<body>
<div id="app">
    @include('desktop.parts.header')
    <div id="content-wrapper">
        <div class="mui-container">
            @yield('page-container')
        </div>
    </main>
    @include('desktop.parts.footer')
</div>

@yield('lover-body-container')
</body>
</html>
