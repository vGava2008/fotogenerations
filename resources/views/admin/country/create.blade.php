@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Добавление стран @endslot
    @slot('parent') Главная @endslot
    @slot('active') Страны @endslot
  @endcomponent

  <hr />

  <form class="form-horizontal" action="{{route('admin.country.store')}}" method="post">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.country.partials.form')
    
  </form>
</div>

@endsection