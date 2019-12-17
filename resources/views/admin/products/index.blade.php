@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список товаров @endslot
    @slot('parent') Главная @endslot
    @slot('active') Товары @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.product.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Добавить товар</a>
  <table class="table table-striped">
    <thead>
      <th>Наименование</th>
      <th>Модель</th>
      <th>Артикул</th>
      <th>Количество</th>
      <th>Цена</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($products as $product)
        <tr>
          @forelse ($product_descriptions as $product_description)
            @if ($product->product_id == $product_description->product_id)
              <td>{{$product_description->name}}</td>
            @else
            @endif
            @empty
          @endforelse
          <td>{{$product->model}}</td>
          <td>{{$product->sku}}</td>
          <td>{{$product->quantity}}</td>
          <td>{{$product->price}}</td>
         
         
          <td class="text-right">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.product.destroy', $product->product_id)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <!--Хэлпер для генерации токена безопасности-->
              {{ csrf_field() }}
              <a class="btn btn-default" href="{{route('admin.product.edit', $product->product_id)}}"><i class="fa fa-edit"></i></a>
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
            {{$products->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection