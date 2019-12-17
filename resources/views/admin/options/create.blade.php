@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Создать опцию @endslot
    @slot('parent') Главная @endslot
    @slot('active') Создать опцию  @endslot
  @endcomponent
  <hr />
  <form class="form-horizontal" action="{{route('admin.option.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.options.partials.form')
    
  </form>
</div>

@endsection