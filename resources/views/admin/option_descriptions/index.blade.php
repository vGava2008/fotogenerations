@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список опций (описание) @endslot
    @slot('parent') Главная @endslot
    @slot('active') Опции (описание) @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.option_description.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать опцию</a>
  <table class="table table-striped">
    <thead>
      <th>option_id</th>
      <th>language_id</th>
      <th>name</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($option_descriptions as $option_description)
        <tr>
          <td>{{$option_description->option_id}}</td>
          <td>{{$option_description->language_id}}</td>
          <td>{{$option_description->name}}</td>
         <!-- <td>@if ($option_description->required == 1) Обязательно к заполнению @else Не обязательно к заполнению @endif</td>-->
          <!--<td>@include('admin.option_descriptions.partials.language', ['languages' => $languages])</td>-->
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.option_description.destroy', $option_description)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.option_description.edit', $option_description)}}"><i class="fa fa-edit"></i></a>
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
            {{$option_descriptions->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection