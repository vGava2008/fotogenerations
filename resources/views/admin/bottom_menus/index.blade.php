@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список меню Footer@endslot
    @slot('parent') Главная @endslot
    @slot('active') Меню Footer @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.bottom_menu.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать пункт меню</a>
  <table class="table table-striped">
    <thead>
      <th>Название пункта</th>
      <th>Ссылка</th>
      <th>Статус</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($bottom_menus as $bottom_menu)
        <tr>
          <td>{{$bottom_menu->id}}</td>
          <td>{{$bottom_menu->bottom_menu_id}}</td>
          <td>{{$bottom_menu->name}}</td>
          <td>{{$bottom_menu->url}}</td>
          <td>@if ($bottom_menu->status == 1) Опубликовано @else Не опубликовано @endif</td>
          <td>{{$bottom_menu->sort_order}}</td>
          <td class="text-right">
          <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.bottom_menu.destroy', $bottom_menu->bottom_menu_id)}}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <!--Хэлпер для генерации токена безопасности-->
            {{ csrf_field() }}
            <a class="btn btn-default" href="{{route('admin.bottom_menu.edit', $bottom_menu->bottom_menu_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$bottom_menus->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection