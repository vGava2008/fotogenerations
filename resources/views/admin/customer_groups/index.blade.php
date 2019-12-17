@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список групп пользователей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Список групп пользователей @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.customer_group.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать группу пользователей</a>
  <table class="table table-striped">
    <thead>
      <th>Название группы</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($groups as $group)
        <tr>
          <td>{{$group->name}}</td>
          <td>{{$group->sort_order}}</td>
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.customer_group.destroy', $group->customer_group_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.customer_group.edit', $group->customer_group_id)}}"><i class="fa fa-edit"></i></a>
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
        <td colspan="3">
          <ul class="pagination pull-right">
            {{$groups->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection