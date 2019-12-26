<header>
            <div class="header-content clearfix">
                <div class="menu-logo">
                    <a href="index.html" class="logo"><img src="../img/logo.png" alt=""></a>
                    <span class="open-menu">
                <span></span>
                    </span>
                    <nav>
                        <ul>
                            <li>
                                <a href="javascript:void(0)">{{ trans('general.top_menu_1') }}</a>
                                <ul>
                                @foreach ($top_menu as $menu)
                                    @if ($menu->status != 'gallery')
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
                            <li><a href="{{asset('/gallery/')}}">{{ trans('general.top_menu_2') }}</a>

                                <ul>
				    <li><a href="{ {asset($menu->url)} }">{{ $menu->name}}</a></li>
                                    <li><a href="gallery-modular.html">Модульные картины</a></li>
                                    <li><a href="gallery-photo.html">Фото картины</a></li>
                                    <li><a href="gallery-reproductions.html">Репродукции</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">{{ trans('general.top_menu_3') }}</a></li>
                            <li><a href="gift-card.html">{{ trans('general.top_menu_4') }}</a></li>
                            <li><a href="{{asset('/blog/category/news')}}">{{ trans('general.top_menu_5') }}</a></li>
                        </ul>
                    </nav>
                    <a href="stocks.html" class="discount">
                        <img src="../img/discount-img.png" alt="">
                        <span><i>%</i></span>
                    </a>
                </div>
                <div class="office-basket-transfer">
                    <a href="personal-area.html" class="office"><i class="icon-icon31"></i><strong>{{ trans('general.lk') }}</strong></a>
                    <a href="basket.html" class="basket"><i class="icon-icon11"></i><strong>{{ trans('general.korzina') }}</strong><span>5</span></a>
                    <ul class="transfer">
                        <li style="text-transform: capitalize;">
                        @foreach ($langs as $lang)
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
                	    @endforeach
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
