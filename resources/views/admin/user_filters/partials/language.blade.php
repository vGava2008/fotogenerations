@foreach ($languages as $lang_select)
	@isset($idea->id)
        @if ($lang_select->id == $idea->language_id)
          {{$lang_select->name or ""}} 
        @endif
    @endisset
@endforeach