@foreach ($questions as $question_list)

  <option value="{{$question_list->id or ""}}"

    @isset($category->id)

      @if ($category->parent_id == $question_list->id)
        selected=""
      @endif

      @if ($category->id == $question_list->id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$question_list->title or ""}}
  </option>

  @if (count($question_list->children) > 0)

    @include('admin.categories.partials.categories', [
      'categories' => $question_list->children,
      'delimiter'  => ' - ' . $delimiter
    ])

  @endif
@endforeach