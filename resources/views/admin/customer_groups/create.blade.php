@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Группы пользователей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Создание группы пользователей  @endslot
  @endcomponent

  <hr />
  <form class="form-horizontal" action="{{route('admin.customer_group.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.customer_groups.partials.form')
    
  </form>
</div>

@endsection