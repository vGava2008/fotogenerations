@foreach ($categories as $category_select)

  <option value="{{$category_select->id or ""}}"

    @isset($idea->id)

      @if ($idea->category_id == $category_select->id)
        selected=""
      @endif
 
      @if ($idea->id == $category_select->id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$category_select->title or ""}}
  </option>

  @if (count($category_select->children) > 0)

    @include('admin.ideas.partials.categories', [
      'categories' => $category_select->children,
      'delimiter'  => ' - ' . $delimiter
    ])

  @endif
@endforeach