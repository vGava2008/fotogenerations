@include('page.head')
<body>
	<div class="wrapper">
		@include('page.partials.stocksPopups')

{{--        @include('page.partials.stocksPopups')--}}
        @include('layouts.header')
		@section('title', trans('stocks.stocks_title') . " - VIAR")
		<div class="bread-crumbs">
			<i class="icon-icon3"></i>
			<ul>
				<li><a href="/">Главная</a></li>
				<li><span>{{ trans('stocks.stocks_title') }}</span></li>
			</ul>
		</div>

		@include('page.partials.stocksBody')


	</div>
</body>
@include('layouts.foother')