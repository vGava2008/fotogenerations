@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<label>Изображение</label><br> 

@if (isset($category->id))
@if ($category->image != null)
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/images/category/' . $category->image)}}" alt="{{$category->title}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="image">

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#panel1">Русский</a></li>
  <li><a data-toggle="tab" href="#panel2">English</a></li>
  <li><a data-toggle="tab" href="#panel3">Latviešu</a></li>
  <li><a data-toggle="tab" href="#panel4">Eesti</a></li>
  <li><a data-toggle="tab" href="#panel5">Lietuvių</a></li>
</ul>
<div class="tab-content">
	@foreach ($languages as $lang_select)
		@if ($lang_select->id == 1) 
		<div id="panel{{$lang_select->id}}" class="tab-pane fade in active">
		@else
		<div id="panel{{$lang_select->id}}" class="tab-pane fade">
		@endif

		<label for="">Наименование для <strong>{{$lang_select->name}}</strong></label>
		<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">

		<input type="text" class="form-control" name="title{{$lang_select->id}}" placeholder="Заголовок категории для {{$lang_select->name}}" 

		@if (isset($category->id)) 
		@foreach ($choose_category as $category_select)
		@if ($lang_select->id == $category_select->language_id)
		value="{{$category_select->title}}"
		@endif
		@endforeach 
		@else value="" 
		@endif required>

		<label for="">Подзаголовок для <strong>{{$lang_select->name}}</strong></label>
		<input type="text" class="form-control" name="sub_title{{$lang_select->id}}" placeholder="Подзаголовок категории для {{$lang_select->name}}" 

		@if (isset($category->id)) 
		@foreach ($choose_category as $category_select)
		@if ($lang_select->id == $category_select->language_id)
		value="{{$category_select->sub_title}}"
		@endif
		@endforeach 
		@else value="" 
		@endif>

		<label for="">Описание для <strong>{{$lang_select->name}}</strong></label>
		<input type="text" class="form-control" name="description{{$lang_select->id}}" placeholder="Описание категории для {{$lang_select->name}}" 

		@if (isset($category->id)) 
		@foreach ($choose_category as $category_select)
		@if ($lang_select->id == $category_select->language_id)
		value="{{$category_select->description}}"
		@endif
		@endforeach 
		@else value="" 
		@endif>

</div>
		@endforeach
</div>
@if (isset($category->id)) 
<input type="hidden" name="category_id" value="{{$category->id}}">
@endif
{{--dd($choose_category)--}}

<label for="">Статус публикации</label>
<select class="form-control" name="published">
  @if (isset($category->id))
    <option value="0" @if ($category->published == 0) selected="" @endif>Не опубликовано</option>
    <option value="1" @if ($category->published == 1) selected="" @endif>Опубликовано</option>
  @else
    <option value="0">Не опубликовано</option>
    <option value="1">Опубликовано</option>
  @endif
</select>

<label for="">Отображение на странице</label>
<select class="form-control" name="show_page">
  @if (isset($category->id))
    <option value="0" @if ($category->show_page == 0) selected="" @endif>Нет</option>
    <option value="1" @if ($category->show_page == 1) selected="" @endif>Да</option>
  @else
    <option value="0">Нет</option>
    <option value="1">Да</option>
  @endif
</select>

<label for="">Порядок сортировки</label>
<input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" value="{{$category->sort_order or ""}}">


<label for="">Уникальное название поля для всех языковых пакетов</label>
<p><strong>Только маленькими английскими буквами</strong></p>
<input type="text" class="form-control" name="seo_link" placeholder="Уникальное название поля" value="{{$category->seo_link or ""}}">

<label for="">Родительская категория</label>
<select class="form-control" name="parent_id">
  <option value="0">-- без родительской категории --</option>
  @include('admin.categories.partials.categories', ['categories' => $categories])
</select>

<!--<label for="">Язык</label>
<select class="form-control" name="language_id">
<option value="0">-- Язык не выбран --</option>
 {{-- @include('admin.categories.partials.language', ['languages' => $languages]) --}}
</select>
<hr /> -->
<input class="btn btn-primary" type="submit" value="Сохранить">