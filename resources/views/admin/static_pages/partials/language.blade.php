@foreach ($languages as $lang_select)
	@isset($blog->id)
        @if ($lang_select->id == $blog->language_id)
          {{$lang_select->name or ""}} 
        @endif
    @endisset
@endforeach