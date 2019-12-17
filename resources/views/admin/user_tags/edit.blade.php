@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb') 
    @slot('title') Статус пользователей @endslot 
    @slot('parent') Главная @endslot
    @slot('active') Редактирование статуса пользователя @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.user_tag.update', $user_tag)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.user_tags.partials.form')
    
  </form>
</div>

@endsection