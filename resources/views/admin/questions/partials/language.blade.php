@foreach ($languages as $lang_select)
	@isset($question->id)
        @if ($lang_select->id == $question->language_id)
          {{$lang_select->name or ""}} 
        @endif
    @endisset
@endforeach