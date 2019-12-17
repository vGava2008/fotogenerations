@foreach ($regions as $region_select)

  <option value="{{$region_select->id or ""}}"

    @isset($user->id)
        @if ($region_select->id == $user->region)
          selected="selected"
        @endif
    @endisset
  >
  {{$region_select->region_name or ""}} 
  {{-- $user->country --}}
  </option>
@endforeach