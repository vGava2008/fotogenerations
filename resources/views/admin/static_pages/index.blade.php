@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список страниц Top@endslot
    @slot('parent') Главная @endslot
    @slot('active') Страницы @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.static_page.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать страницу</a>
  <table class="table table-striped">
    <thead>
      <th>Имя страницы</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($static_pages as $static_page)
        <tr>
          <td>{{$static_page->title}}</td>
          
          <td class="text-right">
          <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.static_page.destroy', $static_page->static_page_id)}}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <!--Хэлпер для генерации токена безопасности-->
            {{ csrf_field() }}
            <a class="btn btn-default" href="{{route('admin.static_page.edit', $static_page->static_page_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$static_pages->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection