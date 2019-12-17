@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Статус пользователей @endslot 
    @slot('parent') Главная @endslot
    @slot('active') Список статусов пользователей @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.user_tag.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать статус</a>
  <table class="table table-striped">
    <thead>
      <th>Название статуса</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($user_tags as $user_tag)
        <tr>
          <td>{{$user_tag->name}}</td>
          
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.user_tag.destroy', $user_tag->user_tag_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.user_tag.edit', $user_tag->user_tag_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$user_tags->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection