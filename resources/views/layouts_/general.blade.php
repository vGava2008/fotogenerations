
<section class="banner">
            <span class="banner-ground1"></span>
            <span class="banner-ground2"></span>
            <div class="banner-slider">
            @foreach ($banners as $banner)
                <div class="banner-item clearfix" style="background: url({{asset('/img/'.$banner->name) }})
no-repeat 20% 50%; background-size: cover;"></div>
            @endforeach

            </div>
            <div class="banner-content clearfix">
                <div class="slider-text">
                    <div class="img">
                        <span class="banner-ground3"></span>
                        <img src="../img/banner-img.png" alt="">
                    </div>
                    <img src="../img/brush.png" alt="" class="banner-text">
                    <p>Modern Art Studio</p>
                </div>
            </div>
            <div class="facebook-banner">
                <a href="javascript:void(0)"></a>
                <img src="../img/facebook-banner.png" alt="">
                <p>
                    {{ trans('general.fb_action') }}
                    <span>{{ trans('general.fb') }}</span>
                </p>
            </div>
            <div class="foto-slider">




<?php $i=1; ?>
@foreach ($categories as $category)

                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img<?php echo $i; ?>.png" alt="" class="foto-item1">
                    <img src="../img/foto-img<?php echo $i+1; ?>.png" alt="" class="foto-item2">
                    <h3>{{ $category->title }}</h3>

                </div>

<?php
$i++;
if ($i == 11) { $i = 1;}
?>

@endforeach
<!--

                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img3.png" alt="" class="foto-item3">
                    <img src="../img/foto-img4.png" alt="" class="foto-item4">
                    <h3>коллажи</h3>
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <h3>модульные картины</h3>
                    <img src="../img/foto-img5.png" alt="" class="foto-item5">
                    <img src="../img/foto-img6.png" alt="" class="foto-item6">
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img7.png" alt="" class="foto-item7">
                    <img src="../img/foto-img8.png" alt="" class="foto-item8">
                    <h3>готовые картины</h3>
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img9.png" alt="" class="foto-item9">
                    <img src="../img/foto-img10.png" alt="" class="foto-item10">
                    <h3>электронная живопись</h3>
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img1.png" alt="" class="foto-item1">
                    <img src="../img/foto-img2.png" alt="" class="foto-item2">
                    <h3>фотокартины и композиции</h3>
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img3.png" alt="" class="foto-item3">
                    <img src="../img/foto-img4.png" alt="" class="foto-item4">
                    <h3>коллажи</h3>
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <h3>модульные картины</h3>
                    <img src="../img/foto-img5.png" alt="" class="foto-item5">
                    <img src="../img/foto-img6.png" alt="" class="foto-item6">
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img7.png" alt="" class="foto-item7">
                    <img src="../img/foto-img8.png" alt="" class="foto-item8">
                    <h3>готовые картины</h3>
                </div>
                <div class="foto-item" style="background: url('../img/foto-slider-bg.png') no-repeat 50% 50%; background-size: cover;">
                    <a href="javascript:void(0)"></a>
                    <img src="../img/foto-img9.png" alt="" class="foto-item9">
                    <img src="../img/foto-img10.png" alt="" class="foto-item10">
                    <h3>электронная живопись</h3>
                </div>
-->
            </div>
        </section>

<?php $i = 1; ?>
@foreach ($categories as $category)
<?php if ($category->sort_order == 1) { ?>
        <section class="foto clearfix">
            <img src="../img/foto-content-img1.png" alt="" class="foto-content-img1">
            <div class="foto-content clearfix">
                <div class="foto-text">
                    <div class="title">
                        <h2>{{ $category->title}}</h2>
                    </div>
                    <p>{{ $category->description }}</p>
                    <a href="javascript:void(0)"><span>{{ trans('general.zakazat') }}</span></a>
                </div>
            </div>
            <img src="../img/foto-content-img2.png" alt="" class="foto-content-img2">
        </section>
<?php } ?>


<?php if ($category->sort_order == 2) { ?>

        <section class="collages">
            <div class="clearfix">
                <img src="../img/collages-content-img1.png" alt="" class="collages-content-img1">
                <div class="collages-content clearfix">
                    <div class="collages-text">
                        <div class="title">
                            <h2>{{ $category->title}}</h2>
                            <h4>{{ $category->sub_title}}</h4>
                        </div>
                        <p>{{ $category->description}}
                        </p>
                        <a href="javascript:void(0)"><span>{{ trans('general.zakazat') }}</span></a>
                        <div class="generator">
                            <span>{{ trans('general.gen_collage') }}</span>
                            <i>!</i>
                            <img src="../img/generator-icon.png" alt="">
                        </div>
                    </div>
                </div>
                <img src="../img/collages-content-img2.png" alt="" class="collages-content-img2">
            </div>
        </section>
<?php } ?>

<?php if ($category->sort_order == 1) { ?>
    
        <section class="pictures clearfix">
            <img src="../img/pictures-content-img1.png" alt="" class="pictures-content-img1">
            <div class="pictures-content clearfix">
                <div class="pictures-text">
                    <div class="title">
                        <h2>{{ $category->title }}x</h2>
                        <h4>{{ $category->sub_title}}</h4>
                    </div>
                    <p>* Краткое описание Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <a href="javascript:void(0)"><span>{{ trans('general.create_pic') }}</span></a>
                </div>
            </div>
            <img src="../img/pictures-content-img2.png" alt="" class="pictures-content-img2">
        </section>

    
<?php } ?>

<?php if ($category->sort_order == 4) { ?>

        <section class="gallery">
            <div class="clearfix">
                <img src="../img/gallery-content-img2.png" alt="" class="gallery-content-img2">
                <div class="gallery-content clearfix">
                    <div class="gallery-text">
                        <div class="title">
                            <h2>галерея картин</h2>
                            <h4>текст подзаголовка</h4>
                        </div>
                        <p>* Краткое описание Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        <a href="javascript:void(0)"><span>{{ trans('general.zakazat') }}</span></a>
                    </div>
                </div>
                <img src="../img/gallery-content-img1.png" alt="" class="gallery-content-img1">
            </div>
        </section>

<?php } ?>

<?php if ($category->sort_order == 5) { ?>
        <section class="portrait clearfix">
            <img src="../img/portrait-content-img2.png" alt="" class="portrait-content-img2">
            <div class="portrait-content clearfix">
                <div class="portrait-text">
                    <div class="title">
                        <h2>Графический портрет</h2>
                    </div>
                    <p>* Краткое описание Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <a href="javascript:void(0)"><span>{{ trans('general.see_catalog') }}</span></a>
                </div>
            </div>
            <img src="../img/portrait-content-img1.png" alt="" class="portrait-content-img1">
        </section>
<?php } ?>

<?php if ($category->sort_order == 6) { ?>

        <section class="stylization">
            <div class="clearfix">
                <img src="../img/stylization-content-img1.png" alt="" class="stylization-content-img1">
                <div class="stylization-content clearfix">
                    <div class="stylization-text">
                        <div class="title">
                            <h2>Стилизация</h2>
                            <h4>создай свой образ</h4>
                        </div>
                        <p>* Краткое описание Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        <a href="javascript:void(0)"><span>{{ trans('general.see_catalog') }}</span></a>
                    </div>
                </div>
                <img src="../img/stylization-content-img2.png" alt="" class="stylization-content-img2">
            </div>
        </section>

<?php } ?>

<?php if ($category->sort_order == 7) { ?>

        <section class="oiled clearfix">
            <img src="../img/oiled-content-img2.png" alt="" class="oiled-content-img2">
            <div class="oiled-content clearfix">
                <div class="oiled-text">
                    <div class="title">
                        <h2>Картины маслом</h2>
                        <h4>текст подзаголовка</h4>
                    </div>
                    <p>* Краткое описание Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    <a href="javascript:void(0)"><span>{{ trans('general.zakazat') }}</span></a>
                </div>
            </div>
            <img src="../img/oiled-content-img1.png" alt="" class="oiled-content-img1">
        </section>
<?php } ?>

<?php $i++; ?>


@endforeach
