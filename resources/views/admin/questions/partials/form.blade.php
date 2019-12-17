@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

@foreach ($languages as $lang_select)
	<label for="">Вопрос для языкового пакета "<strong>{{$lang_select->name}}</strong>"</label>
	<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
	<input type="text" class="form-control" name="title{{$lang_select->id}}" placeholder="Вопрос для языкового пакета {{$lang_select->name}}"

	@if (isset($question->id)) 
		@foreach ($choose_question as $question_select)
			@if ($lang_select->id == $question_select->language_id)
				value="{{$question_select->title}}"
			@endif
		@endforeach @else value="" @endif required>

	<label for="">Ответ для языкового пакета "<strong>{{$lang_select->name}}</strong>"</label>
	<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
	<textarea rows="5" cols="45" class="form-control" name="text_info{{$lang_select->id}}" placeholder="Ответ для языкового пакета {{$lang_select->name}}" required>@if(isset($question->id))@foreach($choose_question as $question_select)@if($lang_select->id==$question_select->language_id){{$question_select->text_info}}@endif @endforeach @else @endif</textarea>
@endforeach

@if (isset($question->id)) 
<input type="hidden" name="question_id" value="{{$question->id}}">
@endif
{{--dd($choose_question)--}}

<label for="">Статус публикации</label>
<select class="form-control" name="published">
  @if (isset($question->id))
    <option value="0" @if ($question->published == 0) selected="" @endif>Не опубликовано</option>
    <option value="1" @if ($question->published == 1) selected="" @endif>Опубликовано</option>
  @else
    <option value="0">Не опубликовано</option>
    <option value="1">Опубликовано</option>
  @endif
</select>





<!--<label for="">Язык</label>
<select class="form-control" name="language_id">
<option value="0">-- Язык не выбран --</option>
 {{-- @include('admin.categories.partials.language', ['languages' => $languages]) --}}
</select>
<hr /> -->
<br>
<input class="btn btn-primary" type="submit" value="Сохранить">