<header>
            <div class="header-content clearfix">
                <div class="menu-logo">
                    <a href="#" class="logo"><img src="/img/logo.png" alt=""></a>
                    <span class="open-menu">
                <span></span>
                    </span>
                    <nav>
                        <ul>
                            <li>
                                <a href="javascript:void(0)">Услуги</a>
                                <ul>
                                    <li><a href="">Фото картины и композиции</a></li>
                                    <li><a href="collage.html">Фото Коллажи</a></li>
                                    <li><a href="modular-pictures.html">Модульные картины</a></li>
                                    <li><a href="gallery.html">Галерея картин</a></li>
                                    <li><a href="">Графический портрет</a></li>
                                    <li><a href="">Стилизация</a></li>
                                    <li><a href="">Картины маслом</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="gallery.html">Галерея</a>
                                <ul>
                                    <li><a href="gallery-modular.html">Модульные картины</a></li>
                                    <li><a href="gallery-photo.html">Фото картины</a></li>
                                    <li><a href="gallery-reproductions.html">Репродукции</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">О ViarCanvas</a></li>
                            <li><a href="gift-card.html">Подарочная карта</a></li>
                            <li><a href="javascript:void(0)">Идеи</a></li>
                        </ul>
                    </nav>
                    <a href="stocks.html" class="discount">
                        <img src="/img/discount-img.png" alt="">
                        <span><i>%</i></span>
                    </a>
                </div>
                <div class="office-basket-transfer">
                    <a href="personal-area.html" class="office"><i class="icon-icon31"></i><strong>Личный кабинет</strong></a>
                    <a href="basket.html" class="basket"><i class="icon-icon11"></i><strong>Корзина</strong><span>5</span></a>
                    <ul class="transfer">
                    <li>
                    @foreach ($langs as $lang)
                	<li style="text-transform: capitalize;">
                	<a href="javascript:void(0)"><img src="{{asset('images/'.$lang->locale.'.png') }}" alt="">{{ $lang->locale}}</a>
                	</li>
            	    @endforeach
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