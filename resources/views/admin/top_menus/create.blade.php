@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Создание пункта меню Header @endslot
    @slot('parent') Главная @endslot
    @slot('active') Пункт меню Header @endslot
  @endcomponent
  <hr />

  <form class="form-horizontal" action="{{route('admin.top_menu.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.top_menus.partials.form')
    
  </form>
</div>

@endsection