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
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon.png">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
    <!--<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon.png">-->
    @if($page_id == 1)
    <!-- About -->
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/about.min.js') }}"></script>
    <!-- END: About -->
    @endif()

    @if($page_id == 6)
    <!-- Contacts -->
    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/contacts.min.js') }}"></script>
    <!-- END: Contacts -->
    @endif()

    @if($page_id == 11)
    <!-- Terms Of Sale -->
    <link href="{{ asset('css/terms-sale.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/terms-sale.min.js') }}"></script>
    <!-- END: Terms Of Sale -->
    @endif()

    @if($page_id == 16)
    <!-- Shipping and payment -->
    <link href="{{ asset('css/shipping-payment.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.matchHeight.min.js') }}"></script>
    <script src="{{ asset('/js/slick.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/shipping-payment.min.js') }}"></script>
    <!-- END: Shipping and payment -->
    @endif()

    @if($page_id == 21)
    <!-- Partnership -->
    <link href="{{ asset('css/partnership.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/partnership.min.js') }}"></script>
    <!-- END: Partnership -->
    @endif()

    @if($page_id == 26)
    <!-- Gift Card -->
    <link href="{{ asset('css/gift-card.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/jcf.min.js') }}"></script>
    <script src="{{ asset('/js/jcf.select.min.js') }}"></script>
    <script src="{{ asset('/js/jcf.checkbox.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.matchHeight.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/gift-card.min.js') }}"></script>
    <script src="{{ asset('/js/feedback-card.js') }}"></script>

    <!-- END: Gift Card -->
    @endif()

    @if($page_id == 'faq')
    <!-- FAQ -->
    <link href="{{ asset('css/faq.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/script.min.js') }}"></script>
    <script src="{{ asset('/js/faq.min.js') }}"></script>
    <!-- END: FAQ -->
    @endif()

@if($page_id == 'stocks')
    <!-- stocks -->
        <link href="{{ asset('css/stocks.css') }}" rel="stylesheet">

{{--        <script src="{{ asset('/js/jquery.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/jquery.mask.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/jquery.matchHeight.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/jcf.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/jcf.file.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/slick.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/script.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/stocks.min.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/stocks-celebrates-form.js') }}"></script>--}}
{{--        <script src="{{ asset('/js/custom.js') }}"></script>--}}

        <!-- END: stocks -->
    @endif()
    
    
    
</head>