@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список опций @endslot
    @slot('parent') Главная @endslot
    @slot('active') Опции товаров @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.product_option.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать опцию</a>
  <table class="table table-striped">
    <thead>
      <th>product_option_id</th>
      <th>product_id</th>
      <th>option_id</th>
      <th>option_value</th>
      <th>required</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($product_options as $product_option)
        <tr>
          <td>{{$product_option->product_option_id}}</td>
          <td>{{$product_option->product_id}}</td>
          <td>{{$product_option->option_id}}</td>
          <td>{{$product_option->option_value}}</td>
         <td>@if ($product_option->required == 1) Обязательно к заполнению @else Не обязательно к заполнению @endif</td>
         
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.product_option.destroy', $product_option)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.product_option.edit', $product_option)}}"><i class="fa fa-edit"></i></a>
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
            {{$product_options->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection