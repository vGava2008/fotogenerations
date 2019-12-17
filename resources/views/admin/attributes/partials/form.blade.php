@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<div class="tab-content">
  <div id="panel1" class="tab-pane fade in active">
    <ul class="nav nav-tabs">
      @foreach ($languages as $lang_select) <!--{{$count++}}-->
      
      @if ($count == 1)
      <li class="active"><a data-toggle="tab" href="#{{$lang_select->locale}}">{{$lang_select->name}}</a></li>
      @else
      <li><a data-toggle="tab" href="#{{$lang_select->locale}}">{{$lang_select->name}}</a></li>
      @endif
      @endforeach
    </ul>
    <div class="tab-content">
      <!--{{$count=0}}-->
      @foreach ($languages as $lang_select) <!--{{$count++}}-->
      @if ($count == 1)
     <div id="{{$lang_select->locale}}" class="tab-pane fade in active">
      @else
      <div id="{{$lang_select->locale}}" class="tab-pane fade">
      @endif
          <input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
          <label for="">Название атрибута</label>
          <input type="text" class="form-control" name="name{{$lang_select->id}}" placeholder="Название атрибута" 
          @if (isset($attribute->attribute_id)) 
          @foreach ($choose_attribute_description as $choose_attribute_description_select)
          @if ($choose_attribute_description_select->language_id == $lang_select->id)
          value="{{$choose_attribute_description_select->name}}"
          @endif
          @endforeach @else value="" @endif required>
      </div>
      @endforeach

      <label for="">Группа атрибута</label>
      <select class="form-control" name="attribute_group_id">
        <option value="0">-- Не выбрано --</option>
        @include('admin.attributes.partials.attributes', ['attribute_group_descriptions' => $attribute_group_descriptions])
      </select>

      <label for="">Порядок сортировки</label>

      <input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" 
      @if (isset($attribute->attribute_id)) 
      @foreach ($choose_attribute as $choose_attribute_select)
      value="{{$choose_attribute_select->sort_order}}"
      @endforeach @else value="" @endif required>


      @if (isset($attribute->attribute_id)) 
      <input type="hidden" name="attribute_id" value="{{$attribute->attribute_id}}">
      @else
     
      @endif
      
    </div>
  </div>
</div>
<div>
<input class="btn btn-primary" type="submit" value="Сохранить">
</div>