@extends('admin.layouts.app_admin')

@section('content')
<div class="container">
	<div class="row">
 

	<!--<h1>Добавляем поддержку CKEditor</h1>
            <div class="row">
                    <div class="col-md-12">
                           <textarea name="editor1" id="editor1">
                           </textarea>
                   </div>
           </div>-->



		<div class="col-xs-12" style="text-align: center; font-weight: bold; font-size: 29px;">Клиенты / Пользователи</div>
		<div class="col-xs-12"><hr></div>
		<a href="{{route('admin.user_managment.user.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Пользователи - {{$users_count}}</span></p>
				</div>
			</div>
		</a>
		<a href="{{route('admin.customer_group.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Группы пользователей</span></p>
				</div>
			</div>
		</a>
		<a href="{{route('admin.user_tag.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Статусы пользователей</span></p>
				</div>
			</div>
		</a>
		<!--<a href="{{route('admin.user_filter.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Фильтры пользователей</span></p>
				</div>
			</div>
		</a>-->
		<a href="{{route('admin.country.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Страны - {{$countries_count}}</span></p>
				</div>
			</div>
		</a>
		<a href="{{route('admin.region.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Регионы - {{$regions_count}}</span></p>
				</div>
			</div>
		</a>
		<div class="col-xs-12" style="text-align: center; font-weight: bold; font-size: 29px;">Каталог</div>
		<div class="col-xs-12"><hr></div>
		<a href="{{route('admin.banner.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Баннеры - {{$banners_count}}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.top_menu.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Меню Header - {{$top_menus}}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.bottom_menu.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Меню Footer - {{$bottom_menus}}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.static_page.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Страницы - {{ $static_pages }}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.product.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Товары - {{$products_count}}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.category.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Категории - {{$categories_count}}</span></p>
				</div>
			</div>
		</a>
		<a href="{{route('admin.manufacturer.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Производители - {{$manufacturers_count}}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.attribute.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Атрибуты товара - {{$attributes}}</span></p>
			</div>
		</div>
		</a>
		<a href="{{route('admin.attribute_group.index')}}">
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Группы атрибутов - {{$attributes_group}}</span></p>
			</div>
		</div>
		</a>
		<!--
		<a href="{{route('admin.product_option.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Опции (для товара) - {{$product_options_count}}</span></p>
				</div>
			</div>
		</a>-->
		<a href="{{route('admin.option.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Опции - {{$options_count}}</span></p>
				</div>
			</div>
		</a>
		<!--
		<div class="col-sm-3">
			<div class="jumbotron">
				<p><span class="label label-primary">Заказов - X</span></p>
			</div>
		</div>-->
		<div class="col-xs-12" style="text-align: center; font-weight: bold; font-size: 29px;">Блог / Статьи</div>
		<div class="col-xs-12"><hr></div>
		
		<a href="{{route('admin.blog.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Блог (Новости и Идеи) - {{$blogs_count}}</span></p>
				</div>
			</div>
		</a>

		<!--<a href="{{route('admin.idea.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Идеи (Блог) - {{$ideas_count}}</span></p>
				</div>
			</div>
		</a>-->
		<a href="{{route('admin.question.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Воросы и ответы - {{$questions_count}}</span></p>
				</div>
			</div>
		</a>
		<a href="{{route('admin.category.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Категории - {{$categories_count}}</span></p>
				</div>
			</div>
		</a>
	</div>
	<!--
	<div class="row">
		<div class="col-sm-6">
			
			<a class="btn btn-block btn-default" href="{{route('admin.category.create')}}"> Создать категорию</a>
			<a class="list-group-item" href="#"> 
				<h4 class="list-group-item-heading">Категория первая</h4>
				<p class="list-group-item-text">
					Кол-во товаров
				</p>
			</a>
		</div>
		<div class="col-sm-6">
			<a class="btn btn-block btn-default" href="#"> Добавить товар</a>
			<a class="list-group-item" href="#"> 
				<h4 class="list-group-item-heading">Первый товар</h4>
				<p class="list-group-item-text">
					Категория
				</p>
			</a>
		</div>
	</div>-->
</div>



          <script>
    	/*window.onload = function()
		{

      $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 100
      });
  	}*/
/*
  	$(document).ready(function() {

           $('#technig').summernote({

             height:300,

           });

       });*/
    </script>
    <script>
       /*
setTimeout(function(){
    
    var editor = CKEDITOR.replace( 'editor1' );
},100);
*/
</script>
@endsection