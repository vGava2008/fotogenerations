@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Добавление региона @endslot
    @slot('parent') Главная @endslot
    @slot('active') Регионы @endslot
  @endcomponent

  <hr />

  <form class="form-horizontal" action="{{route('admin.region.store')}}" method="post">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.region.partials.form')
    
  </form>
</div>

@endsection