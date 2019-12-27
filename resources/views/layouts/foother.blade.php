<footer>
    <div class="footer-content clearfix">
        <a class="logo" href="/"><img src="{{asset('img/footer-logo.png')}}" alt=""></a>
        <nav>
            <ul>
                @foreach ($bottom_menu as $menu)
                @if ($menu->column == 1)
                <li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
                @endif
                @endforeach

                @foreach ($bottom_menu as $menu)
                @if ($menu->column == 2)
                <li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
                @endif
                @endforeach

                @foreach ($bottom_menu as $menu)
                @if ($menu->column == 3)
                <li><a href="{{ $menu->url }}">{{ $menu->name }}</a></li>
                @endif
                @endforeach
		    </ul>
        </nav>
        <div class="tel-sosial clearfix">
            <a href="javascript:void(0)" class="discount">
                <img src="{{asset('img/discount-img.png')}}" alt="">
                <span><i>%</i></span>
            </a>
            <div class="tel">
                <p>{{ trans('general.call_russian') }}</p>
                <a href="tel:{{ trans('auth.call_phone') }}">{{ trans('general.call_phone2') }}</a>
            </div>
            <div class="facebook">
                <a href="javascript:void(0)"></a>
                <img src="{{asset('img/facebook-banner.png')}}" alt="">
                <p>
                    {{ trans('general.fb_action') }}
                    <span>{{ trans('general.fb') }}</span>
                </p>
            </div>
        </div>
    </div>
</footer> 
</div>
@yield('js_project')
</body>
</html>