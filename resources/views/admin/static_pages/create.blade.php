@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Создание страницы @endslot
    @slot('parent') Главная @endslot
    @slot('active') Страница @endslot
  @endcomponent
  <hr />

  <form class="form-horizontal" action="{{route('admin.static_page.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.static_pages.partials.form')
    
  </form>
</div>

@endsection