@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список производителей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Производители @endslot
  @endcomponent

  <hr/>

  <form class="form-horizontal" action="{{route('admin.manufacturer.update', $manufacturer)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.manufacturers.partials.form')
    
  </form>
</div>

@endsection