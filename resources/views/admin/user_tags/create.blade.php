@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb') 
    @slot('title') Статус пользователей @endslot
    @slot('parent') Главная @endslot
    @slot('active') Создание статуса пользователя  @endslot
  @endcomponent

  <hr />
  <form class="form-horizontal" action="{{route('admin.user_tag.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.user_tags.partials.form')
    
  </form>
</div>

@endsection