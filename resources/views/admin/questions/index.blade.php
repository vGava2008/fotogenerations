@extends('admin.layouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список категорий @endslot
    @slot('parent') Главная @endslot
    @slot('active') Вопросы и ответы @endslot
  @endcomponent

  <hr>
<!--<p>Русский (ru)<br> Аглийский (en)<br> Латышский(lv)<br> Эстонский(et)<br> Литовский (lt)</p>-->
  <a href="{{route('admin.question.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i> Создать вопрос и ответ</a>
  <table class="table table-striped">
    <thead>
      <th>Вопрос</th>
      <th>Ответ</th>
      <th>Статус публикации</th>
      <th>Язык</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($questions as $question)
        <tr>
          <td>{{$question->title}}</td>
          <td>{{$question->text_info}}</td>
          <td>@if ($question->published == 1) Опубликовано @else Не опубликовано @endif</td>
          <td>@include('admin.questions.partials.language', ['languages' => $languages])</td>
          <td class="text-right">
          	<form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('admin.question.destroy', $question)}}" method="post">
          		<input type="hidden" name="_method" value="DELETE">
          		<!--Хэлпер для генерации токена безопасности-->
          		{{ csrf_field() }}
          		<a class="btn btn-default" href="{{route('admin.question.edit', $question)}}"><i class="fa fa-edit"></i></a>
          		<button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
          	</form>
            
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
        </tr>
      @endforelse
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan="3">
    			<ul class="pagination pull-right">
    				{{$questions->links()}}
    			</ul>
    		</td>
    	</tr>
    </tfoot>
  </table>
</div>

@endsection