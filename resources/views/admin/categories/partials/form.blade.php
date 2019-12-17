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
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/storage/' . $category->image)}}" alt="{{$category->title}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="image">
@foreach ($languages as $lang_select)
<label for="">Наименование для <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">

<input type="text" class="form-control" name="title{{$lang_select->id}}" placeholder="Заголовок категории для {{$lang_select->name}}" 
@if (isset($category->id)) 
@foreach ($choose_category as $category_select)
@if ($lang_select->id == $category_select->language_id)
value="{{$category_select->title}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Описание категории для {{$lang_select->name}}</label>
<textarea class="form-control" name="title{{$lang_select->id}}" placeholder="Описание категории для {{$lang_select->name}}" 
@if (isset($category->id)) 
@foreach ($choose_category as $category_select)
@if ($lang_select->id == $category_select->language_id)
value="{{$category_select->title}}"
@endif
@endforeach @else value="" @endif required>
</textarea>





@endforeach
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

<label for="">Уникальное название поля для всех языковых пакетов</label>
<p><strong>Только маленькими английскими буквами</strong></p>
<input type="text" class="form-control" name="seo_link" placeholder="Уникальное название поля" value="{{$category->seo_link or ""}}" required>

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