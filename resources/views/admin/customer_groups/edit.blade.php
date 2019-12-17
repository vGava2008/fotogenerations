@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb') 
    @slot('title') Группы пользователей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Редактирование группы пользователей @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.customer_group.update', $group)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.customer_groups.partials.form')
    
  </form>
</div>

@endsection