@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Редактирование  пункта меню Footer @endslot
    @slot('parent') Главная @endslot
    @slot('active') Пункт меню Footer @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.bottom_menu.update', $bottom_menu)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.bottom_menus.partials.form')
    
  </form>
</div>

@endsection