@foreach ($languages as $language_select)
    @if($language_select->id == 1)
@foreach ($menus as $menu_select)

  <option value="{{$menu_select->top_menu_id or ""}}"

    @isset($top_menu->top_menu_id)

      @if ($top_menu->parent_id == $menu_select->top_menu_id)
        selected=""
      @endif
 
      @if ($top_menu->top_menu_id == $menu_select->top_menu_id)
        hidden=""
      @endif

    @endisset

    >
    {!! $delimiter or "" !!}{{$menu_select->name or ""}}
  </option>

  @if (count($menu_select->children) > 0)
  
    
      @include('admin.top_menus.partials.menus', [
        'menus' => $menu_select->children,
        'delimiter'  => ' - ' . $delimiter
      ])

  @endif
@endforeach

    @endif
  @endforeach