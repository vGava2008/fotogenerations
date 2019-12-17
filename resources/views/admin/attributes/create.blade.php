@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Добавление атрибута @endslot
    @slot('parent') Главная @endslot
    @slot('active') Атрибуты  @endslot
  @endcomponent 
  <hr />
 
  <form class="form-horizontal" action="{{route('admin.attribute.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
     @include('admin.attributes.partials.form')
    
  </form>
</div>

@endsection