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

		@include('page.partials.stocksStaticPart')

		@include('layouts.foother')
	</div>
		<script src="{{ asset('/js/jquery.min.js') }}"></script>
		<script src="{{ asset('/js/jquery.mask.min.js') }}"></script>
		<script src="{{ asset('/js/jquery.matchHeight.min.js') }}"></script>
		<script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
		<script src="{{ asset('/js/jcf.min.js') }}"></script>
		<script src="{{ asset('/js/jcf.file.min.js') }}"></script>
		<script src="{{ asset('/js/slick.min.js') }}"></script>
		<script src="{{ asset('/js/script.min.js') }}"></script>
		<script src="{{ asset('/js/stocks.min.js') }}"></script>
		<script src="{{ asset('/js/stocks-celebrates-form.js') }}"></script>
		<script src="{{ asset('/js/custom.js') }}"></script>
</body>
