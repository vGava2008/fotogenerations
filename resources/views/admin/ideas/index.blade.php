@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список идей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Идеи (Блог) @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.idea.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать идею</a>
  <table class="table table-striped">
    <thead>
      <th>Заголовок идеи</th>
      <th style="width:30%">Главное изображение</th>
      <th>Краткое содержание</th>
      <th>Статус публикации</th>
      <th>Язык</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($ideas as $idea)
        <tr>
            <td>{{$idea->title}}</td>
          @if ($idea->main_image == null)
            <td><img style="width:30%" src="{{asset('/storage/uploads/' . 'no-image.png')}}" alt="{{$idea->title}}"></td>
          @else
            <td><img style="width:30%" src="{{asset('/storage/' . $idea->main_image)}}" alt="{{$idea->title}}"></td>
          @endif 
         <td>{{ str_limit($idea->text_left, $limit = 30, $end = '...') }}</td>
          <td>@if ($idea->published == 1) Опубликовано @else Не опубликовано @endif</td>
          <td>@include('admin.ideas.partials.language', ['languages' => $languages])</td>
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.idea.destroy', $idea)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.idea.edit', $idea)}}"><i class="fa fa-edit"></i></a>
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
            {{$ideas->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection