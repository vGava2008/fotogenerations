@foreach ($manufacturers as $manufacturer_select)

  <option value="{{$manufacturer_select->id or ""}}"
   
    @isset($product->product_id)

      @if ($product->manufacturer_id == $manufacturer_select->id)
        selected=""
      @endif
 
      @if ($product->id == $manufacturer_select->id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$manufacturer_select->title or ""}}
  </option>

  
@endforeach