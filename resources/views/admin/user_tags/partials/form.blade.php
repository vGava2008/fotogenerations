@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif


<label for="">Название статуса</label>

<input type="text" class="form-control" name="name" placeholder="Название статуса" 
@if (isset($user_tag->user_tag_id)) 
@foreach ($choose_user_tag as $user_tag_select)
@if ($user_tag->user_tag_id == $user_tag_select->user_tag_id)
value="{{$user_tag_select->name}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Описание статуса</label>

<input type="text" class="form-control" name="description" placeholder="Описание статуса" 
@if (isset($user_tag->user_tag_id)) 
@foreach ($choose_user_tag as $user_tag_select)
@if ($user_tag->user_tag_id == $user_tag_select->user_tag_id)
value="{{$user_tag_select->description}}"
@endif
@endforeach @else value="" @endif required>


@if (isset($user_tag->user_tag_id)) 
<input type="hidden" name="user_tag_id" value="{{$user_tag->user_tag_id}}">
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