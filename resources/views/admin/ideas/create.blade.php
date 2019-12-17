@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Создание идеи @endslot
    @slot('parent') Главная @endslot
    @slot('active') Идеи (Блог)  @endslot
  @endcomponent
  <hr />
  <form class="form-horizontal" action="{{route('admin.idea.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.ideas.partials.form')
    
  </form>
</div>

@endsection