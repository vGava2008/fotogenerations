@include('page.head')
<body>
    <div class="wrapper">
    @include('layouts.header')

		@if($page_id == 'faq')
			<!-- FAQ -->
			@section('title', trans('faq.faq_title') . " - VIAR")
		<!-- END: FAQ -->
		@else()
			@section('title', $page->title . " - VIAR")
		@endif()

<!--page/index.blade-->

<div class="bread-crumbs">
    <i class="icon-icon3"></i>
    <ul>
        <li><a href="/">Главная</a></li>
        @if($page_id == 'faq')
			<!-- FAQ -->
			{{ trans('faq.faq_title') }}
		<!-- END: FAQ -->
		@else()
			<li><span>{{$page->title}}</span></li>
		@endif()
        
        

    </ul>
</div>
@if($page_id == 26)
<!-- Gift Card - Feedback -->
@include('page.partials.form')
<!-- END: Gift Card - Feedback -->
@endif()
@if($page_id == 'faq')
<!-- FAQ -->
@include('page.partials.faq')
<!-- END: FAQ -->
@else
{!! htmlspecialchars_decode($page->text) !!}
@endif()


<!--END: page/index.blade-->

@section('content')

@endsection
</div>
@include('layouts.foother')