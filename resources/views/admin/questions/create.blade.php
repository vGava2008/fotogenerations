@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Создание категории @endslot
    @slot('parent') Главная @endslot
    @slot('active') Вопросы и ответы @endslot
  @endcomponent

  <hr />

  <form class="form-horizontal" action="{{route('admin.question.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    {{-- Form include --}}
    @include('admin.questions.partials.form')
    
  </form>
</div>

@endsection