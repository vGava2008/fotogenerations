@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#panel1">Русский</a></li>
  <li><a data-toggle="tab" href="#panel2">English</a></li>
  <li><a data-toggle="tab" href="#panel3">Latviešu</a></li>
  <li><a data-toggle="tab" href="#panel4">Eesti</a></li>
  <li><a data-toggle="tab" href="#panel5">Lietuvių</a></li>
</ul>
<div class="tab-content">
	@foreach ($languages as $lang_select)
		@if ($lang_select->id == 1) 
		<div id="panel{{$lang_select->id}}" class="tab-pane fade in active">
		@else
		<div id="panel{{$lang_select->id}}" class="tab-pane fade">
		@endif
			<label>Имя страницы</label><br>
<input type="text" class="form-control" name="title{{$lang_select->id}}" placeholder="Имя страницы"
			@if (isset($static_page->static_page_id)) 
          @foreach ($choose_static_page as $static_page_select)
          @if ($static_page_select->language_id == $lang_select->id)
          value="{{$static_page_select->title}}"
          @endif
          @endforeach @else value="" @endif required>


			<label for="">Содержимое страницы</label>
			<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
			<textarea name="text{{$lang_select->id}}" id="editor{{$lang_select->id}}">
			@if (isset($static_page->static_page_id)) 
			@foreach ($choose_static_page as $static_page_select)
			@if ($lang_select->id == $static_page_select->language_id)
			{{$static_page_select->text}}
			{!! htmlspecialchars_decode($static_page_select->text) !!}

			@endif
			@endforeach 
			@else 
			@endif
			</textarea>
			<script>
				setTimeout(function(){
    				var editor = CKEDITOR.replace( 'editor{{$lang_select->id}}' );
				},100);
			</script>
		</div>
	@endforeach
</div>

@if (isset($static_page->static_page_id)) 
<input type="hidden" name="static_page_id" value="{{$static_page->static_page_id}}">
@else
<!--<input type="hidden" name="category_id" value="0">-->
@endif
		
<input class="btn btn-primary" type="submit" value="Сохранить">