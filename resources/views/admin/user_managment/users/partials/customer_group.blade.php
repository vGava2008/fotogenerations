@foreach ($customer_groups as $group_select)

  <option value="{{$group_select->customer_group_id or ""}}"

    @isset($user->id)
        @if ($group_select->customer_group_id == $user->customer_group_id)
          selected="selected"
        @endif
    @endisset
  >
  {{$group_select->name or ""}} 
  {{-- $user->country --}}
  </option>
@endforeach