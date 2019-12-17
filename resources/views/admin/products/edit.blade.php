@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Редактирование товара @endslot
    @slot('parent') Главная @endslot
    @slot('active') Товар @endslot
  @endcomponent

  <hr/>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#panel1">Основное</a></li>
  <li><a data-toggle="tab" href="#panel2">Данные</a></li>
  <li><a data-toggle="tab" href="#panel3">Связи</a></li>
  <li><a data-toggle="tab" href="#panel4">Атрибуты</a></li>
  <li><a data-toggle="tab" href="#panel5">Опции</a></li>
  <li><a data-toggle="tab" href="#panel6">Изображения</a></li>
  <li><a data-toggle="tab" href="#panel7">Скидки</a></li>
  <li><a data-toggle="tab" href="#panel8">Акции</a></li>
  
</ul>
  <form class="form-horizontal" action="{{route('admin.product.update', $product)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.products.partials.form')
    
  </form>
</div>

@endsection