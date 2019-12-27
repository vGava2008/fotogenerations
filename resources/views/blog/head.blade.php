<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="description" content="@yield('meta_description')">


    <meta name="cmsmagazine" content="5a7189a28fb3dc68238dbdb44c9ea99c" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">
    <!--<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon.png">-->
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon.png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.matchHeight.min.js') }}"></script>
    <script src="{{ asset('/js/slick.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/blog.min.js') }}"></script>
</head>