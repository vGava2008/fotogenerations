@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')  
    @slot('title') Фильтры пользователей @endslot 
    @slot('parent') Главная @endslot
    @slot('active') Редактирование фильтра пользователя @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.user_filter.update', $user_filter)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.user_filters.partials.form')
    
  </form>
</div>

@endsection