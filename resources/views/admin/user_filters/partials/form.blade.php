@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif


<label for="">Название фильтра</label>

<input type="text" class="form-control" name="name" placeholder="Название фильтра" 
@if (isset($user_filter->user_filter_id)) 
@foreach ($choose_user_filter as $user_filter_select)
@if ($user_filter->user_filter_id == $user_filter_select->user_filter_id)
value="{{$user_filter_select->name}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Описание фильтра</label>

<input type="text" class="form-control" name="description" placeholder="Описание фильтра" 
@if (isset($user_filter->user_filter_id)) 
@foreach ($choose_user_filter as $user_filter_select)
@if ($user_filter->user_filter_id == $user_filter_select->user_filter_id)
value="{{$user_filter_select->description}}"
@endif
@endforeach @else value="" @endif >


@if (isset($user_filter->user_filter_id)) 
<input type="hidden" name="user_filter_id" value="{{$user_filter->user_filter_id}}">
@else

@endif
{{--dd($choose_idea)--}}


<!--<label for="">Язык</label>
<select class="form-control" name="language_id">
<option value="0">-- Язык не выбран --</option>
 {{-- @include('admin.categories.partials.language', ['languages' => $languages]) --}}
</select>
<hr /> -->
<input class="btn btn-primary" type="submit" value="Сохранить">