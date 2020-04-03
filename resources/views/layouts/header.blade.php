<header>
    <div class="header-content clearfix">
        <div class="menu-logo">
            <a href="/" class="logo"><img src="{{asset('img/logo.png')}}" alt=""></a>
            <span class="open-menu">
                <span></span>
            </span>
            <nav>
                <ul>
                    <li>
                        @foreach ($top_menu as $menu)
                            @if ($menu->top_menu_id == '6')
                            <a href="{{asset($menu->url)}}">{{ $menu->name }}</a>
                            @endif
                        @endforeach
                        
                        <ul>
                        @foreach ($top_menu as $menu)
                            @if ($menu->parent_id == '6')
                            <!--<li><a href="{{asset($menu->url)}}">{{ $menu->name }}</a></li>-->
                            <li><a href="{{asset($menu->url)}}">{{ $menu->name }}</a></li>
                            @endif
                        @endforeach
                        <!--
                            <li><a href="">Фото картины и композиции</a></li>
                            <li><a href="collage.html">Фото Коллажи</a></li>
                            <li><a href="modular-pictures.html">Модульные картины</a></li>
                            <li><a href="gallery.html">Галерея картин</a></li>
                            <li><a href="">Графический портрет</a></li>
                            <li><a href="">Стилизация</a></li>
                            <li><a href="">Картины маслом</a></li>
                        -->
                        </ul>
                    </li>
                    <li>
                        @foreach ($top_menu as $menu)
                            @if ($menu->top_menu_id == '41')
                            <a href="{{asset($menu->url)}}">{{ $menu->name }}</a>
                            @endif
                        @endforeach
                        <ul>
                        @foreach ($top_menu as $menu)
                            @if ($menu->parent_id == '41')
                            <li><a href="{{asset($menu->url)}}">{{ $menu->name }}</a></li>
                            @endif
                        @endforeach
		                    <!--<li><a href="{ {asset($menu->url)} }">{{ $menu->name}}</a></li>
                            <li><a href="gallery-modular.html">Модульные картины</a></li>
                            <li><a href="gallery-photo.html">Фото картины</a></li>
                            <li><a href="gallery-reproductions.html">Репродукции</a></li>-->
                        </ul>
                    </li>
                    @foreach ($top_menu as $menu)
                        @if ($menu->top_menu_id == '61')
                        <li><a href="{{asset($menu->url)}}">{{ $menu->name }}</a></li>
                        @endif
                    @endforeach
                    @foreach ($top_menu as $menu)
                        @if ($menu->top_menu_id == '66')
                        <li><a href="{{asset($menu->url)}}">{{ $menu->name }}</a></li>
                        @endif
                    @endforeach
                    @foreach ($top_menu as $menu)
                        @if ($menu->top_menu_id == '71')
                        <li><a href="{{asset($menu->url)}}">{{ $menu->name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </nav>
            <a href="/stocks" class="discount">
                <img src="{{asset('img/discount-img.png')}}" alt="">
                <span><i>%</i></span>
            </a>
        </div>
        <div class="office-basket-transfer">
            <a href="javascript:void(0)" class="office"><i class="icon-icon31"></i><strong>{{ trans('general.lk') }}</strong></a>
            <a href="javascript:void(0)" class="basket"><i class="icon-icon11"></i><strong>{{ trans('general.korzina') }}</strong><span>5</span></a>
            <ul class="transfer">
                <li style="text-transform: capitalize;">
                     <!--<a href="/lang/ru">RU - Test</a>
                     <a href="/lang/en">EN - Test</a>-->
                 @foreach ($langs as $lang_single)
                    @if($lang_single->id==$lang)
                    <a href="/lang/<?=$lang_single->locale ?>">
                    <img src="{{asset('images/'.$lang_single->locale.'.png') }}" alt="">{{ $lang_single->locale}}</a>
                    @else
                    @endif
                @endforeach
                <ul>
                @foreach ($langs as $lang_single)
                    <li style="text-transform: capitalize;">
                       <a href="/lang/<?=$lang_single->locale ?>">
                       <img src="{{asset('images/'.$lang_single->locale.'.png') }}" alt="">{{ $lang_single->locale}}</a>
                    </li>
                @endforeach
                <!-- Метод Димы - старый -->     
                <!--@foreach ($langs as $lang)
                    @if($lang->id==1)
                    <a href="<?= route('setlocale', ['lang' => $lang->locale]) ?>">
                    <img src="{{asset('images/'.$lang->locale.'.png') }}" alt="">{{ $lang->locale}}</a>

                  
                    @else
                    @endif
                @endforeach
                <ul>
                @foreach ($langs as $lang)
                	<li style="text-transform: capitalize;">
                	   <a href="<?= route('setlocale', ['lang' => $lang->locale]) ?>">
                	   <img src="{{asset('images/'.$lang->locale.'.png') }}" alt="">{{ $lang->locale}}</a>
                	</li>
        	    @endforeach-->
                <!-- END: Метод Димы - старый -->    
                </ul>
    	       </li>
            </ul>
<!--
            <ul class="transfer">
                <li>
                    <a href="javascript:void(0)"><img src="../img/transfer-img1.png" alt=""> Ru</a>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img src="../img/transfer-img2.png" alt=""> En</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../img/transfer-img3.png" alt=""> Lv</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../img/transfer-img4.png" alt=""> Ee</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../img/transfer-img5.png" alt=""> Lt</a>
                        </li>
                    </ul>
                </li>
            </ul>
-->
        </div>
    </div>
</header>
