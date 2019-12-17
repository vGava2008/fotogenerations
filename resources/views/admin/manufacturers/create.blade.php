@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Создание производителя @endslot
    @slot('parent') Главная @endslot
    @slot('active') Производители @endslot
  @endcomponent

  <hr />

  <form class="form-horizontal" action="{{route('admin.manufacturer.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.manufacturers.partials.form')
    
  </form>
</div>

@endsection