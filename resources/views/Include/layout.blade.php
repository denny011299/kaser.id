<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    @include('Include.General_css')
    @yield('custom_css')
    <style>
        html,body{
            overflow-x: hidden;
        }
    </style>
</head>
<body >
    <div class="">
        @yield('body')
    </div>
    @include('Include.General_js')
 
</body>
</html>
<script>
    
</script>
@yield('custom_js')
