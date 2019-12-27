@include('page.head')
<body>
    <div class="wrapper">
    @include('layouts.header')

@section('title', $page->title . " - VIAR")

<!--page/index.blade-->

<div class="bread-crumbs">
    <i class="icon-icon3"></i>
    <ul>
        <li><a href="/">Главная</a></li>
        <li><span>{{$page->title}}</span></li>

    </ul>
</div>

{!! htmlspecialchars_decode($page->text) !!}

<!--END: page/index.blade-->

@section('content')

@endsection
</div>
@include('layouts.foother')