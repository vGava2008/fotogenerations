@foreach ($languages as $lang_select)
	@isset($category->id)
        @if ($lang_select->id == $category->language_id)
          {{$lang_select->name or ""}} 
        @endif
    @endisset
@endforeach