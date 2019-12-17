@foreach ($attribute_descriptions as $attribute_description_select)

  <option value="{{$attribute_description_select->attribute_id or ""}}"
   
    @isset($product_attribute->attribute_id)
    
    
      @if ($product_attribute->attribute_id == $attribute_description_select->attribute_id)
        selected=""
      @endif
 
      @if ($product_attribute->product_id == $attribute_description_select->attribute_id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$attribute_description_select->name or ""}}
  </option>

  
@endforeach


