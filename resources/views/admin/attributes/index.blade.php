@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Атрибуты @endslot
    @slot('parent') Главная @endslot 
    @slot('active') Атрибуты @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.attribute.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Добавить атрибут</a>
  <table class="table table-striped">
    <thead>
      <th>Имя атрибута</th>
      <th>Группа атрибута</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($attributes as $attribute)
        <tr>
          @forelse ($attribute_descriptions as $attribute_description)
            @if ($attribute_description->attribute_id == $attribute->attribute_group_id)
              <td>{{$attribute_description->name}}</td>
            @else
              <td>Не найдено</td>
            @endif
          @empty
              <td>Не найдено</td>
          @endforelse

          @forelse ($attribute_group_descriptions as $attribute_group_description)
            @if ($attribute_group_description->attribute_group_id == $attribute->attribute_group_id)
              <td>{{$attribute_group_description->name}}</td>
            @else
              <td>Не найдено</td>
            @endif
          @empty
              <td>Не найдено</td>
          @endforelse

          <td>{{$attribute->sort_order}}</td>
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.attribute.destroy', $attribute->attribute_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.attribute.edit', $attribute->attribute_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$attributes->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection