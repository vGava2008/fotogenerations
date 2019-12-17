@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Группы атрибутов @endslot
    @slot('parent') Главная @endslot 
    @slot('active') Группы атрибутов @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.attribute_group.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Добавить группу</a>
  <table class="table table-striped">
    <thead>
      <th>Название группы</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($attribute_groups as $attribute_group)
        <tr>
          @forelse ($attribute_group_descriptions as $attribute_group_description)
            @if ($attribute_group_description->attribute_group_id == $attribute_group->attribute_group_id)
              <td>{{$attribute_group_description->name}}</td>
            @else
              <td>Не найдено</td>
            @endif
          @empty
              <td>Не найдено</td>
          @endforelse
          <td>{{$attribute_group->sort_order}}</td>
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.attribute_group.destroy', $attribute_group->attribute_group_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.attribute_group.edit', $attribute_group->attribute_group_id)}}"><i class="fa fa-edit"></i></a>
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
        <td colspan="6">
          <ul class="pagination pull-right">
            {{$attribute_groups->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection