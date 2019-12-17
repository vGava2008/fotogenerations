@foreach ($countries as $country_select)

  <option value="{{$country_select->id or ""}} "

    @isset($user->id)
      {{--@foreach ($user->country as $country_user) --}}
        @if ($country_select->id == $user->country)
          selected="selected"
        @endif
      {{-- @endforeach --}}
    @endisset
  >
  {{$country_select->country_name or ""}} 
  {{-- $user->country --}}
  </option>
@endforeach