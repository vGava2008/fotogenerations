@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<label for="">Название баннера</label>
<input type="text" class="form-control" name="name" placeholder="Название баннера" 
@if (isset($banner->banner_id)) 
value="{{$banner->name}}"
@else value="" @endif required>

<label>Изображение баннера</label><br>
@if (isset($banner->banner_id))
@if ($banner->image != null)
<td><img style="width:15%; margin-bottom: 20px;" src="{{asset('/images/banner/' . $banner->image)}}" alt="{{$banner->name}}"></td>
@endif 
@endif 
<input type="file" class="form-control" name="image">

<label for="">Порядок сортировки</label>
<input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" value="{{$banner->sort_order or ""}}">

<!-- {{--
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
			<label for="">Название баннера для языкового пакета <strong>{{$lang_select->name}}</strong></label>
			<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
			<input type="text" class="form-control" name="name{{$lang_select->id}}" placeholder="Название баннера для языкового пакета {{$lang_select->name}}" 
			@if (isset($banner->banner_id)) 
			@foreach ($choose_banner as $banner_select)
			@if ($lang_select->id == $banner_select->language_id)
			value="{{$banner_select->name}}"
			@endif
			@endforeach @else value="" @endif required>
		</div>
	@endforeach
</div>
--}}-->
		


		@if (isset($banner->banner_id)) 
		<input type="hidden" name="banner_id" value="{{$banner->banner_id}}">
		@else
		<!--<input type="hidden" name="category_id" value="0">-->
		@endif
		
<input class="btn btn-primary" type="submit" value="Сохранить">