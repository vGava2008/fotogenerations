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

@if (isset($manufacturer->id))
@if ($manufacturer->image != null)
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/storage/' . $manufacturer->image)}}" alt="{{$manufacturer->title}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="image">
@foreach ($languages as $lang_select)
<label for="">Наименование для <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">

<input type="text" class="form-control" name="title{{$lang_select->id}}" placeholder="Заголовок категории для {{$lang_select->name}}" 
@if (isset($manufacturer->id)) 
@foreach ($choose_manufacturer as $manufacturer_select)
@if ($lang_select->id == $manufacturer_select->language_id)
value="{{$manufacturer_select->title}}"
@endif
@endforeach @else value="" @endif required>



@endforeach
@if (isset($manufacturer->id)) 
<input type="hidden" name="id" value="{{$manufacturer->id}}">
@endif


<label for="">Статус публикации</label>
<select class="form-control" name="published">
  @if (isset($manufacturer->id))
    <option value="0" @if ($manufacturer->published == 0) selected="" @endif>Не опубликовано</option>
    <option value="1" @if ($manufacturer->published == 1) selected="" @endif>Опубликовано</option>
  @else
    <option value="0">Не опубликовано</option>
    <option value="1">Опубликовано</option>
  @endif
</select>

<label for="">Уникальное название поля для всех языковых пакетов</label>
<p><strong>Только маленькими английскими буквами</strong></p>
<input type="text" class="form-control" name="seo_link" placeholder="Уникальное название поля" value="{{$manufacturer->seo_link or ""}}" required>

<input class="btn btn-primary" type="submit" value="Сохранить">