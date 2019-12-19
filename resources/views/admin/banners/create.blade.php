@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Создание баннера @endslot
    @slot('parent') Главная @endslot
    @slot('active') Баннер @endslot
  @endcomponent
  <hr />

  <form class="form-horizontal" action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.banners.partials.form')
    
  </form>
</div>

@endsection