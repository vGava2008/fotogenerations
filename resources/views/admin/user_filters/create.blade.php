@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb') 
    @slot('title') Фильтры пользователей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Создание фильтра пользователя  @endslot
  @endcomponent

  <hr />
  <form class="form-horizontal" action="{{route('admin.user_filter.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.user_filters.partials.form')
    
  </form>
</div>

@endsection