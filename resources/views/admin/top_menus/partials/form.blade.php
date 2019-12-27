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
			@if (isset($top_menu->top_menu_id)) 
			@foreach ($choose_top_menu as $top_menu_select)
			@if ($lang_select->id == $top_menu_select->language_id)
			value="{{$top_menu_select->name}}"
			@endif
			@endforeach @else value="" @endif required>
		</div>
	@endforeach
</div>

<label>Ссылка</label><br>
<input type="text" class="form-control" name="url" placeholder="Ссылка" value="{{$top_menu->url or ""}}">


<label for="">Родительский пункт меню</label>
<select class="form-control" name="parent_id">
  <option value="0">-- не выбрано --</option>
  @include('admin.top_menus.partials.menus', ['menus' => $menus, 'languages' => $languages])
</select>


<label for="">Статус публикации</label>
<select class="form-control" name="status">
  @if (isset($top_menu->top_menu_id))
    <option value="0" @if ($top_menu->status == 0) selected="" @endif>Не опубликовано</option>
    <option value="1" @if ($top_menu->status == 1) selected="" @endif>Опубликовано</option>
  @else
    <option value="0">Не опубликовано</option>
    <option value="1">Опубликовано</option>
  @endif
</select>

<label for="">Порядок сортировки</label>
<input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" value="{{$top_menu->sort_order or ""}}">

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
		


		@if (isset($top_menu->top_menu_id)) 
		<input type="hidden" name="top_menu_id" value="{{$top_menu->top_menu_id}}">
		@else
		<!--<input type="hidden" name="category_id" value="0">-->
		@endif
		
<input class="btn btn-primary" type="submit" value="Сохранить">