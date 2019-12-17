@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Редактирование стран @endslot
    @slot('parent') Главная @endslot
    @slot('active') Страны @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.category.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.country.update', $country)}}" method="post">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.country.partials.form')
    
  </form>
</div>

@endsection