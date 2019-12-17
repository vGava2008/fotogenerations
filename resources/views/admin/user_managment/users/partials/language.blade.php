@foreach ($langs as $lang_select)

  <option value="{{$lang_select->id or ""}}"

    @isset($user->id)
        @if ($lang_select->id == $user->language_id)
          selected="selected"
        @endif
    @endisset
  >
  {{$lang_select->name or ""}} 
  {{-- $user->country --}}
  </option>
@endforeach