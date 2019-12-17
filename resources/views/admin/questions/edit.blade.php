@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Редактирование категории @endslot
    @slot('parent') Главная @endslot
    @slot('active') Вопросы и ответы @endslot
  @endcomponent

  <hr/>
<!--
  <form class="form-horizontal" action="{{route('admin.question.store')}}" method="post">-->
  <form class="form-horizontal" action="{{route('admin.question.update', $question)}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.questions.partials.form')
    
  </form>
</div>

@endsection