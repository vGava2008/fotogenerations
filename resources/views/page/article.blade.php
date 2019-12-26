@include('blog.head')
<body>
    <div class="wrapper">
    @include('blog.header')

@section('title', $article->title . " - VIAR")

<!--blog/article.blade-->
<div class="bread-crumbs">
            <i class="icon-icon3"></i>
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/blog/article">Блог</a></li>
                <li><span>{{$article->title}}</span></li>
            </ul>
        </div>

        <section class="blog-lnner">
            <div class="title">
                <h2>Новости и идеи</h2>
            </div>
            <div class="blog-content">
                <i>Июнь 04, 2019</i>
                <h3>{{$article->title}}</h3>
                <div class="blog-article">
                    <article>
                        <div class="blog-img clearfix">
                            <div class="img" style="background: url('{{asset('/images/blog/' . $article->main_image)}}') no-repeat 50% 50%; background-size: cover;"></div>
                            <div class="img" style="background: url('{{asset('/images/blog/' . $article->second_image)}}') no-repeat 50% 50%; background-size: cover;">
                                <div>
                                    <h5>{{$article->title_second_image}}</h5>
                                </div>
                            </div>
                        </div>
                        <h4>{{$article->title_second_level}}</h4>
                        <div class="text">
                            <p>{{$article->text_left}}</p>
                            <p>{{$article->text_right}}</p>
                        </div>
                    </article>
                    <article>
                        <div class="img" style="background: url('{{asset('/images/blog/' . $article->third_center_image)}}') no-repeat 50% 50%; background-size: cover;">
                            <div><h5>{{$article->title_third_center_image}}</h5></div>
                        </div>
                        <div class="text">
                            <p>{{$article->text_centr}}</p>
                        </div>
                    </article>
                </div>
                <ul class="social">
                    <li>
                        <a href="javascript:void(0)" target="_blank"><img src="/img/social-blog1.png" alt=""></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" target="_blank"><img src="/img/social-blog2.png" alt=""></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" target="_blank"><img src="/img/social-blog3.png" alt=""></a>
                    </li>
                </ul>
            </div>
        </section>
<!--END: blog/article.blade-->

@section('content')

@endsection
</div>
@include('layouts.foother')