@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список значений опций @endslot
    @slot('parent') Главная @endslot
    @slot('active') Опции (значения) @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.option.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать значение опции</a>
  <table class="table table-striped">
    <thead>
      <th>Опция</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($options as $option)
  
        <tr>
          @forelse ($option_descriptions as $option_description)
            @if ($option->option_id == $option_description->option_id)
              <td>{{$option_description->name}}</td>
            @else
            @endif
          @empty
          @endforelse
          <td>{{$option->sort_order}}</td>
          <!--<td>@if ($option->required == 1) Обязательно к заполнению @else Не обязательно к заполнению @endif</td>-->
          <!--<td>@include('admin.options.partials.language', ['languages' => $languages])</td>-->
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.option.destroy', $option->option_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.option.edit', $option->option_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$options->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection