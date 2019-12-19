@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список баннеров @endslot
    @slot('parent') Главная @endslot
    @slot('active') Баннеры @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.banner.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать баннер</a>
  <table class="table table-striped">
    <thead>
      <th>Название баннра</th>
      <th style="width:30%">Изображение</th>
      <th>Порядок сортировки</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($banners as $banner)
        <tr>
            <td>{{$banner->name}}</td>
          @if ($banner->image == null)
            <td><img style="width:30%" src="{{asset('/images/banner/' . 'no-image.png')}}" alt="{{$banner->name}}"></td>
          @else
            <td><img style="width:30%" src="{{asset('/images/banner/' . $banner->image)}}" alt="{{$banner->name}}"></td>
          @endif 
          <td>{{$banner->sort_order}}</td>
          <td class="text-right">
          <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.banner.destroy', $banner->banner_id)}}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <!--Хэлпер для генерации токена безопасности-->
            {{ csrf_field() }}
            <a class="btn btn-default" href="{{route('admin.banner.edit', $banner->banner_id)}}"><i class="fa fa-edit"></i></a>
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
        <td colspan="5">
          <ul class="pagination pull-right">
            {{$banners->links()}}
          </ul>
        </td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection