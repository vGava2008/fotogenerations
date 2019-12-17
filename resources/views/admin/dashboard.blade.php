@extends('admin.layouts.app_admin')

@section('content')
<div class="container">
	<div class="row">
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
		</a>
		<a href="{{route('admin.option.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Опции - {{$options_count}}</span></p>
				</div>
			</div>
		</a>-->
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
					<p><span class="label label-primary">Новости (Блог) - {{$blogs_count}}</span></p>
				</div>
			</div>
		</a>
		<a href="{{route('admin.idea.index')}}">
			<div class="col-sm-3">
				<div class="jumbotron">
					<p><span class="label label-primary">Идеи (Блог) - {{$ideas_count}}</span></p>
				</div>
			</div>
		</a>
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
@endsection