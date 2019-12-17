@extends('admin.layouts.app_admin')

@section('content')

<div class="container">
  @component('admin.components.breadcrumb')
    @slot('title') Добавление Группы атрибутов @endslot
    @slot('parent') Главная @endslot
    @slot('active') Группа атрибутов  @endslot
  @endcomponent
  <hr />
 
  <form class="form-horizontal" action="{{route('admin.attribute_group.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
     @include('admin.attribute_groups.partials.form')
    
  </form>
</div>

@endsection