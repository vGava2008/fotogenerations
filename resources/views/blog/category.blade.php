
@include('blog.head')
<body>
    <div class="wrapper">
    @include('layouts.header')



<!--blog/category.blade-->
<div class="bread-crumbs">
            <i class="icon-icon3"></i>
            <ul>
                <li><a href="index.html">Главная</a></li>
                <li><span>Блог</span></li>
            </ul>
        </div>
<section class="blog">
            <div class="title">
                <h2>Новости и идеи</h2>
                <h5>ViarStudia</h5>
                <p>Это может быть интересным для вас</p>
            </div>
            <div class="blog-content clearfix">
                <div class="blog-ideas">
                    <h2>Интересные идеи</h2>
                    <div class="slider-ideas">
                    	@forelse ($ideas as $idea)
						<div class="ideas-item">
                            <div class="img">
                                <img src="{{asset('/images/blog/' . $idea->main_image)}}" alt="{{$idea->title}}">
                            </div>
                            <h3>{{$idea->title}}</h3>
                            <a href="{{route('article', $idea->seo_link)}}"><span>Подробнее</span></a>
                        </div>
                    	@empty
                    		{{-- empty expr --}}
                    	@endforelse
                    </div>
                </div>
                <div class="blog-article">
                    <div class="blog-items clearfix">
                    	@forelse ($articles as $article)
						<div class="blog-item">

                            <div class="img" style="background: url('{{asset('/images/blog/' . $article->main_image)}}') no-repeat 50% 50%; background-size: cover;"></div>
                            <h3>{{$article->title}}</h3>
                            <p> <?= str_limit($article->text_left, 201) ?></p>
                            <a href="{{route('article', $article->seo_link)}}"><span>Подробнее</span></a>
                        </div>
                    	@empty
                    		{{-- empty expr --}}
                    	@endforelse
                    </div>
                    <div class="clearfix">
                        <a class="download" href="javascript:void(0)">Загрузить еще</a>
                    </div>
                </div>
            </div>
        </section>
<!--END: blog/category.blade-->

@section('content')

@endsection
</div>
@include('layouts.foother')