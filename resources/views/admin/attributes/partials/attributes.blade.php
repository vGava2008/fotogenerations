@foreach ($attribute_group_descriptions as $attribute_group_description_select)

  <option value="{{$attribute_group_description_select->attribute_group_id or ""}}"
   
    @isset($attribute->attribute_id)

      @if ($attribute->attribute_group_id == $attribute_group_description_select->attribute_group_id)
        selected=""
      @endif
 
      @if ($attribute->attribute_group_id == $attribute_group_description_select->attribute_group_id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$attribute_group_description_select->name or ""}}
  </option>

  
@endforeach