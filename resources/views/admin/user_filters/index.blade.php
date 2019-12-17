@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Фильтры пользователей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Список фильтров пользователей @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.user_filter.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать фильтр</a>
  <table class="table table-striped">
    <thead>
      <th>Название фильтра</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($user_filters as $user_filter)
        <tr>
          <td>{{$user_filter->name}}</td>
          
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.user_filter.destroy', $user_filter->user_filter_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.user_filter.edit', $user_filter->user_filter_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$user_filters->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection