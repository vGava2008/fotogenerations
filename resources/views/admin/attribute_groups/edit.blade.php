@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Редактирование группы атрибутов @endslot
    @slot('parent') Главная @endslot
    @slot('active') Группа атрибутов @endslot
  @endcomponent

  <hr/>
  <form class="form-horizontal" action="{{route('admin.attribute_group.update', $attribute_group )}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.attribute_groups.partials.form')
    
  </form>
</div>

@endsection