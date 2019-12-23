@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Создание пункта меню Footer @endslot
    @slot('parent') Главная @endslot
    @slot('active') Пункт меню Footer @endslot
  @endcomponent
  <hr />

  <form class="form-horizontal" action="{{route('admin.bottom_menu.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.bottom_menus.partials.form')
    
  </form>
</div>

@endsection