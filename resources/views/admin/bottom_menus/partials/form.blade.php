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
			<label for="">Название пункта меню <strong>{{$lang_select->name}}</strong></label>
			<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
			<input type="text" class="form-control" name="name{{$lang_select->id}}" placeholder="Название пункта меню" 
			@if (isset($bottom_menu->bottom_menu_id)) 
			@foreach ($choose_bottom_menu as $bottom_menu_select)
			@if ($lang_select->id == $bottom_menu_select->language_id)
			value="{{$bottom_menu_select->name}}"
			@endif
			@endforeach @else value="" @endif required>
		</div>
	@endforeach
</div>

<label>Ссылка</label><br>
<input type="text" class="form-control" name="url" placeholder="Ссылка" value="{{$bottom_menu->url or ""}}">

<label for="">Расположение</label>
<select class="form-control" name="column">
  @if (isset($bottom_menu->bottom_menu_id))
    <option value="1" @if ($bottom_menu->column == 1) selected="" @endif>Слева</option>
    <option value="2" @if ($bottom_menu->column == 2) selected="" @endif>По центру</option>
    <option value="3" @if ($bottom_menu->column == 3) selected="" @endif>Справа</option>
  @else
    <option value="1">Слева</option>
    <option value="2">По центру</option>
    <option value="3">Справа</option>
  @endif
</select>

<label for="">Статус публикации</label>
<select class="form-control" name="status">
  @if (isset($bottom_menu->bottom_menu_id))
    <option value="0" @if ($bottom_menu->status == 0) selected="" @endif>Не опубликовано</option>
    <option value="1" @if ($bottom_menu->status == 1) selected="" @endif>Опубликовано</option>
  @else
    <option value="0">Не опубликовано</option>
    <option value="1">Опубликовано</option>
  @endif
</select>

<label for="">Порядок сортировки</label>
<input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" value="{{$bottom_menu->sort_order or ""}}">

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
		


		@if (isset($bottom_menu->bottom_menu_id)) 
		<input type="hidden" name="bottom_menu_id" value="{{$bottom_menu->bottom_menu_id}}">
		@else
		<!--<input type="hidden" name="category_id" value="0">-->
		@endif
		
<input class="btn btn-primary" type="submit" value="Сохранить">