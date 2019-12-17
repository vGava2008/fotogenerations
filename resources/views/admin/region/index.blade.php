@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список регионов @endslot
    @slot('parent') Главная @endslot
    @slot('active') Регионы @endslot
  @endcomponent

  <hr>

  <a href="{{route('admin.region.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Добавить регион</a>
  <table class="table table-striped">
    <thead>
      <th>Название</th>
      <th>language_id</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($regions as $region)
        <tr>
          <td>{{$region->region_name}}</td>
          <td>{{$region->language_id}}</td>
          <td class="text-right">
          	<form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.region.destroy', $region)}}" method="post">
          		<input type="hidden" name="_method" value="DELETE">
          		<!--Хэлпер для генерации токена безопасности-->
          		{{ csrf_field() }}
          		<a class="btn btn-default" href="{{route('admin.region.edit', $region)}}"><i class="fa fa-edit"></i></a>
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
    				{{$regions->links()}}
    			</ul>
    		</td>
    	</tr>
    </tfoot>
  </table>
</div>

@endsection