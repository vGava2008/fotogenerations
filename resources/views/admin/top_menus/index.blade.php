@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список меню Top@endslot
    @slot('parent') Главная @endslot
    @slot('active') Top Меню @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.top_menu.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать пункт меню</a>
  <table class="table table-striped">
    <thead>
      <th>Название пункта</th>
      <th>Ссылка</th>
      <th>Статус</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($top_menus as $top_menu)
        <tr>
          <td>{{$top_menu->name}}</td>
          <td>{{$top_menu->url}}</td>
          <td>@if ($top_menu->status == 1) Опубликовано @else Не опубликовано @endif</td>
          <td>{{$top_menu->sort_order}}</td>
          <td class="text-right">
          <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.top_menu.destroy', $top_menu->top_menu_id)}}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <!--Хэлпер для генерации токена безопасности-->
            {{ csrf_field() }}
            <a class="btn btn-default" href="{{route('admin.top_menu.edit', $top_menu->top_menu_id)}}"><i class="fa fa-edit"></i></a>
            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
          </form>
          
        </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center"><h2>Данные отсутствуют</h2></td>
        </tr>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5">
          <ul class="pagination pull-right">
            {{$top_menus->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection