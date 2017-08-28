<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Meşk arşivi">
        <meta name="author" content="Derviş Mehmed">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Meşk</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    </head>
    <body id="page-top" class="index">
    
        @include('layouts.partials._navigation')
        
        @include('layouts.partials._warning')

        @yield('content')
    
        @include('layouts.partials._footer')
    
        @yield('footer')
        
    </body>
</html>
