@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список производителей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Производители @endslot
  @endcomponent
 
  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.manufacturer.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать производителя</a>
  <table class="table table-striped">
    <thead>
      <th style="width:30%">Изображение</th>
      <th>Наименование</th>
      <th>Статус публикации</th>
      <th>Язык</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($manufacturers as $manufacturer)
        <tr>
          @if ($manufacturer->image == null)
            <td><img style="width:30%" src="{{asset('/storage/uploads/' . 'no-image.png')}}" alt="{{$manufacturer->title}}"></td>
          @else
            <td><img style="width:30%" src="{{asset('/storage/' . $manufacturer->image)}}" alt="{{$manufacturer->title}}"></td>
          @endif 
          <td>{{$manufacturer->title}}</td>
          <td>@if ($manufacturer->published == 1) Опубликовано @else Не опубликовано @endif</td>
          <td>@include('admin.manufacturers.partials.language', ['languages' => $languages])</td>
          <td class="text-right">
          	<form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.manufacturer.destroy', $manufacturer)}}" method="post">
          		<input type="hidden" name="_method" value="DELETE">
          		<!--Хэлпер для генерации токена безопасности-->
          		{{ csrf_field() }}
          		<a class="btn btn-default" href="{{route('admin.manufacturer.edit', $manufacturer->id)}}"><i class="fa fa-edit"></i></a>
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
    				{{$manufacturers->links()}}
    			</ul>
    		</td>
    	</tr>
    </tfoot>
  </table>
</div>

@endsection