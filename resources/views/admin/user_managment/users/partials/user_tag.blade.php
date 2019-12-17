@foreach ($user_tags as $tag_select)

  <option value="{{$tag_select->user_tag_id or ""}}"

    @isset($user->id)
        @if ($tag_select->user_tag_id == $user->user_tag_id)
          selected="selected"
        @endif
    @endisset
  >
  {{$tag_select->name or ""}} 
  {{-- $user->country --}}
  </option>
@endforeach