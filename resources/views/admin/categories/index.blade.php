@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список категорий @endslot
    @slot('parent') Главная @endslot
    @slot('active') Категории @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.category.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать категорию</a>
  <table class="table table-striped">
    <thead>
      <th style="width:30%">Изображение</th>
      <th>Наименование</th>
      <th>Статус публикации</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($categories as $category)
        <tr>
          @if ($category->image == null)
            <td><img style="width:30%" src="{{asset('/storage/uploads/' . 'no-image.png')}}" alt="{{$category->title}}"></td>
          @else
            <td><img style="width:30%" src="{{asset('/storage/' . $category->image)}}" alt="{{$category->title}}"></td>
            <td><img style="width:30%" src="{{asset('/img/admin/' . $category->image)}}" alt="{{$category->title}}"></td>
          @endif 
          <td>{{$category->title}}</td>
          <td>@if ($category->published == 1) Опубликовано @else Не опубликовано @endif</td>
          
          <td class="text-right">
          	<form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.category.destroy', $category)}}" method="post">
          		<input type="hidden" name="_method" value="DELETE">
          		<!--Хэлпер для генерации токена безопасности-->
          		{{ csrf_field() }}
          		<a class="btn btn-default" href="{{route('admin.category.edit', $category)}}"><i class="fa fa-edit"></i></a>
          		<button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
          	</form>
            
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
        </tr>
      @endforelse
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan="3">
    			<ul class="pagination pull-right">
    				{{$categories->links()}}
    			</ul>
    		</td>
    	</tr>
    </tfoot>
  </table>
</div>

@endsection