@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<label>Главное изображение идеи</label><br>
@if (isset($idea->id))
@if ($idea->main_image != null)
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/storage/' . $idea->main_image)}}" alt="{{$idea->title}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="main_image">

<label>Второстепенное изображение идеи</label><br>
@if (isset($idea->id))
@if ($idea->second_image != null)
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/storage/' . $idea->second_image)}}" alt="{{$idea->title_second_image}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="second_image">

<label>Центральное изображение идеи (внизу)</label><br>
@if (isset($idea->id))
@if ($idea->third_center_image != null)
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/storage/' . $idea->third_center_image)}}" alt="{{$idea->title_third_center_image}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="third_center_image">


@foreach ($languages as $lang_select)
<label for="">Заголовок идеи для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<input type="text" class="form-control" name="title{{$lang_select->id}}" placeholder="Заголовок идеи для языкового пакета {{$lang_select->name}}" 
@if (isset($idea->id)) 
@foreach ($choose_idea as $idea_select)
@if ($lang_select->id == $idea_select->language_id)
value="{{$idea_select->title}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Описание второго изображения для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<input type="text" class="form-control" name="title_second_image{{$lang_select->id}}" placeholder="Описание второго изображения для языкового пакета {{$lang_select->name}}"
@if (isset($idea->id)) 
@foreach ($choose_idea as $idea_select)
@if ($lang_select->id == $idea_select->language_id)
value="{{$idea_select->title_second_image}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Заголовок второго уровня для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<input type="text" class="form-control" name="title_second_level{{$lang_select->id}}" placeholder="Заголовок второго уровня для языкового пакета {{$lang_select->name}}"
@if (isset($idea->id)) 
@foreach ($choose_idea as $idea_select)
@if ($lang_select->id == $idea_select->language_id)
value="{{$idea_select->title_second_level}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Текст в левой колонке для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">

<textarea rows="5" cols="45" class="form-control" name="text_left{{$lang_select->id}}" placeholder="Текст в левой колонке для языкового пакета {{$lang_select->name}}" required>@if(isset($idea->id))@foreach($choose_idea as $idea_select)@if($lang_select->id==$idea_select->language_id){{$idea_select->text_left}}@endif @endforeach @else @endif</textarea>

<label for="">Текст в правой колонке для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<textarea rows="5" cols="45" class="form-control" name="text_right{{$lang_select->id}}" placeholder="Текст в правой колонке для языкового пакета {{$lang_select->name}}" required>@if(isset($idea->id))@foreach($choose_idea as $idea_select)@if($lang_select->id==$idea_select->language_id){{$idea_select->text_right}}@endif @endforeach @else @endif</textarea>

<label for="">Описание центрального изображения (внизу) для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<input type="text" class="form-control" name="title_third_center_image{{$lang_select->id}}" placeholder="Описание центрального изображения для языкового пакета {{$lang_select->name}}"
@if (isset($idea->id)) 
@foreach ($choose_idea as $idea_select)
@if ($lang_select->id == $idea_select->language_id)
value="{{$idea_select->title_third_center_image}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Текст по центру (внизу) для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<textarea rows="5" cols="45" class="form-control" name="text_centr{{$lang_select->id}}" placeholder="Текст по центру (внизу) для языкового пакета {{$lang_select->name}}" required>@if(isset($idea->id))@foreach($choose_idea as $idea_select)@if($lang_select->id==$idea_select->language_id){{$idea_select->text_centr}}@endif @endforeach @else @endif</textarea>

@endforeach

<label for="">Статус публикации</label>
<select class="form-control" name="published">
  @if (isset($idea->id))
    <option value="0" @if ($idea->published == 0) selected="" @endif>Не опубликовано</option>
    <option value="1" @if ($idea->published == 1) selected="" @endif>Опубликовано</option>
  @else
    <option value="0">Не опубликовано</option>
    <option value="1">Опубликовано</option>
  @endif
</select>

<label for="">Уникальное название поля для всех языковых пакетов</label>
<p><strong>Только маленькими английскими буквами</strong></p>
<input type="text" class="form-control" name="seo_link" placeholder="Уникальное название поля" value="{{$idea->seo_link or ""}}" required>


@if (isset($idea->id)) 
<input type="hidden" name="idea_id" value="{{$idea->id}}">
@else
<input type="hidden" name="category_id" value="0">
@endif
{{--dd($choose_idea)--}}
<label for="">Родительская категория</label>
<select class="form-control" name="category_id">
  <option value="0">-- без родительской категории --</option>
  @include('admin.ideas.partials.categories', ['categories' => $categories])
</select>

<!--<label for="">Язык</label>
<select class="form-control" name="language_id">
<option value="0">-- Язык не выбран --</option>
 {{-- @include('admin.categories.partials.language', ['languages' => $languages]) --}}
</select>
<hr /> -->
<input class="btn btn-primary" type="submit" value="Сохранить">