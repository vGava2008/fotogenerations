@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список новостей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Новости (Блог) @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.blog.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать новость</a>
  <table class="table table-striped">
    <thead>
      <th>Заголовок новости</th>
      <th style="width:30%">Главное изображение</th>
      <th>Краткое содержание</th>
      <th>Статус публикации</th>
      <th>Язык</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($blogs as $blog)
        <tr>
            <td>{{$blog->title}}</td>
          @if ($blog->main_image == null)
            <td><img style="width:30%" src="{{asset('/storage/uploads/' . 'no-image.png')}}" alt="{{$blog->title}}"></td>
          @else
            <td><img style="width:30%" src="{{asset('/storage/' . $blog->main_image)}}" alt="{{$blog->title}}"></td>
          @endif 
         <td>{{ str_limit($blog->text_left, $limit = 30, $end = '...') }}</td>
          <td>@if ($blog->published == 1) Опубликовано @else Не опубликовано @endif</td>
          <td>@include('admin.blogs.partials.language', ['languages' => $languages])</td>
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.blog.destroy', $blog)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.blog.edit', $blog)}}"><i class="fa fa-edit"></i></a>
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
            {{$blogs->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection