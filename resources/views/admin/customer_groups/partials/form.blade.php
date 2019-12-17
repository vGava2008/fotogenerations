@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif


<label for="">Название группы пользователей</label>

<input type="text" class="form-control" name="name" placeholder="Название группы пользователей" 
@if (isset($group->customer_group_id)) 
@foreach ($choose_group as $group_select)
@if ($group->customer_group_id == $group_select->customer_group_id)
value="{{$group_select->name}}"
@endif
@endforeach @else value="" @endif required>

<label for="">Описание групы</label>

<input type="text" class="form-control" name="description" placeholder="Описание группы" 
@if (isset($group->customer_group_id)) 
@foreach ($choose_group as $group_select)
@if ($group->customer_group_id == $group_select->customer_group_id)
value="{{$group_select->description}}"
@endif
@endforeach @else value="" @endif required>


<label for="">Порядок сортировки</label>

<input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" 
@if (isset($group->customer_group_id)) 
@foreach ($choose_group as $group_select)
@if ($group->customer_group_id == $group_select->customer_group_id)
value="{{$group_select->sort_order}}"
@endif
@endforeach @else value="" @endif required>



@if (isset($group->customer_group_id)) 
<input type="hidden" name="customer_group_id" value="{{$group->customer_group_id}}">
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