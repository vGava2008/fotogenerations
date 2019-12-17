@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Редактирование регионов @endslot
    @slot('parent') Главная @endslot
    @slot('active') Регионы @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.region.update', $region)}}" method="post">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.region.partials.form')
    
  </form>
</div>

@endsection