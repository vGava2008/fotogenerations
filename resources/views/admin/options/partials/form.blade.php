@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif



@foreach ($languages as $lang_select)
<label for="">Название опции для языкового пакета <strong>{{$lang_select->name}}</strong></label>
<input type="hidden" name="language{{$lang_select->id}}" value="{{$lang_select->id}}">
<input type="text" class="form-control" name="name{{$lang_select->id}}" placeholder="Название опции для языкового пакета {{$lang_select->name}}" 
@if (isset($option->option_id)) 
@foreach ($choose_option_description as $option_select)
@if ($lang_select->id == $option_select->language_id)
value="{{$option_select->name}}"
@endif
@endforeach @else value="" @endif required>

@endforeach

<label for="">Тип опции</label>
<select class="form-control" name="type" id="input-type" onchange="ClickSelect()">
  @if (isset($option->option_id))
  <optgroup label="Выбор">                       
    <option value="select" @if ($option->type == 'select') selected="" @endif>Список</option>
    <option value="radio" @if ($option->type == 'radio') selected="" @endif>Переключаетель</option>
    <option value="checkbox" @if ($option->type == 'checkbox') selected="" @endif>Флажок</option>
  </optgroup>
  <optgroup label="Поле ввода">
    <option value="text" @if ($option->type == 'text') selected="" @endif>Текст</option>
    <option value="textarea" @if ($option->type == 'textarea') selected="" @endif>Текстовая область</option>
  </optgroup>
      
  @else
   <option value="empty">--Не выбрано--</option>
  <optgroup label="Выбор">                       
    <option value="select">Список</option>
    <option value="radio">Переключаетель</option>
    <option value="checkbox">Флажок</option>
  </optgroup>
  <optgroup label="Поле ввода">
    <option value="text">Текст</option>
    <option value="textarea">Текстовая область</option>
  </optgroup>
  @endif
</select>

<label for="">Порядок сортировки</label>
<input type="text" class="form-control" name="sort_order" placeholder="Порядок сортировки" value="{{$option->sort_order or ""}}">


@if (isset($option->option_id)) 
<input type="hidden" name="option_id" value="{{$option->option_id}}">
@else
@endif
{{--dd($choose_option)--}}

<!--Значения опций-->
<div>
<fieldset>
	<legend>Значение</legend>
	<table id="option-value" class="table table-striped table-bordered table-hover">
	  <thead>
	    <tr>
	      <td class="text-left required">Значение опции</td>
	      <td class="text-center">Изображение</td>
	      <td class="text-right">Порядок сортировки</td>
	      <td></td>
	    </tr>
	  </thead>
	  <tbody>
              @php ($option_value_row = 1)
              @if (isset($choose_option_values))
              	@php ($count_option_value = 0)
 				@foreach ($choose_option_values as $choose_option_value)
              		@if ($choose_option_value->option_id == $count_option_value) 
              		<!--Повтор-->
              		@else
				        <input type="hidden" id="option_value_active{{ $option_value_row }}" name="option_value_active{{ $option_value_row }}" value="2"> 
                <input type="hidden" id="option_id{{ $option_value_row }}" name="option_id{{ $option_value_row }}" value="{{$choose_option_value->option_id}}">
                <input type="hidden" id="option_value_id{{ $option_value_row }}" name="option_value_id{{ $option_value_row }}" value="{{$choose_option_value->option_value_id}}">


              
              <tr id="option-value-row{{ $option_value_row }}">
                <td class="text-center">
                  @foreach ($languages as $language)
                  @foreach ($choose_option_value_descriptions as $choose_option_value_description)
                    @if ($choose_option_value_description->language_id == $language->id && $choose_option_value_description->option_value_id == $choose_option_value->option_value_id) 
	                  <div class="input-group">
	                  	<span class="input-group-addon">{{$language->name}}</span>
	                    <input type="text" name="option_value{{ $option_value_row }}[option_value_description_name{{$language->id}}]" value="{{$choose_option_value_description->name}}" placeholder="Введите значение опции" class="form-control" />
	                  </div>
                  	@endif
                  @endforeach
                  @endforeach
                </td>
                <td class="text-left">
                	<img src="{{asset('/storage/' . $choose_option_value->image)}}" style="width: 40%;" alt="" title="" data-placeholder="Изображение" /></a>
                    <input type="hidden" name="option_value{{ $option_value_row }}[image]" value="{{ $choose_option_value->image }}" id="input-image{{ $option_value_row }}" />
              	</td>
                <td class="text-right">
                	<input type="text" name="option_value{{ $option_value_row }}[sort_order]" value="{{ $choose_option_value->sort_order }}" class="form-control" />
                </td>
                <td class="text-right">
                	<button type="button" onclick="removeOptionValues({{ $option_value_row }}); " data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                </td>
              </tr>
               @php ($option_value_row = $option_value_row + 1)
              @endif
            @endforeach
          @else
            <!-- NOT FOUND ATTRIBUTES -->
          @endif
                </tbody>
              
              <tfoot>
                <tr>
                  <td colspan="3"></td>
                  <td class="text-right"><button type="button" onclick="addOptionValue();" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
              </tfoot>
              
            </table>
          </fieldset>
          <input type="hidden" id="option_row_count" name="option_row_count" value="">
      </div>
      <script type="text/javascript"><!--

function removeOptionValues(option_value_row) {
  var opt_value_row = option_value_row;
  $('#option-value-row' + opt_value_row + '').remove();
  document.getElementById("option_value_active" + opt_value_row + '').value = 3;
}

var option_value_row = {{$option_value_row}};
function checkCountOptionValues() {
  //console.log('Check');
  var option_value_row_count = document.getElementById("option_row_count");
  option_value_row_count.value = option_value_row;
}
setInterval(checkCountOptionValues, 1000);
 //--></script>

 <script type="text/javascript"><!--

  function ClickSelect() {
$('select[name=\'type\']').on('change', function() {
  if (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox' || this.value == 'image') {
    $('#option-value').parent().show();
  } else {
    $('#option-value').parent().hide();
  }
});
}
$('select[name=\'type\']').trigger('change');

var option_value_row = {{ $option_value_row }};
@if (isset($choose_option_values))
var latest_option_value_id = {{ $latest_option_value_id }};
@else
var latest_option_value_id = option_value_row;
@endif

function addOptionValue() {
  html  = '<tr id="option-value-row' + option_value_row + '">';
  html += '<td class="text-left">';
  
  @foreach ($languages as $language)
  html += '<div class="input-group">';
  html += '<span class="input-group-addon">{{$language->name}}</span><input type="text" name="option_value' + option_value_row + '[option_value_description_name{{$language->id}}]" value="" placeholder="Введите значение опции" class="form-control" />';
  html += '    </div>';
  @endforeach
  html += '</td>';
  html += '<td class="text-center">';
  html += '<input type="file" class="form-control" name="option_value' + option_value_row + '[image]" id="input-image' + option_value_row + '">';
  html += '</td>';

  html += '<td class="text-right"><input type="number" name="option_value' + option_value_row + '[sort_order]" value="" class="form-control" /></td>';
  html += '  <td class="text-right"><button type="button" onclick="removeOptionValues(' + option_value_row + '); " data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  html += '<input type="hidden" id="option_value_id' + option_value_row + '" name="option_value_id' + option_value_row + '" value="' + latest_option_value_id + '"> ';

html += '<input type="hidden" id="option_value_active' + option_value_row + '" name="option_value_active' + option_value_row + '" value="1">';
html += '<input type="hidden" id="option_id' + option_value_row + '" name="option_id' + option_value_row + '" value="' + option_value_row + '">';

 
                

  $('#option-value tbody').append(html);
  latest_option_value_id++;
  option_value_row++;
}
//--></script>
<!--
<fieldset>
	<legend>Значение</legend>
	<table id="option-value" class="table table-striped table-bordered table-hover">
	  <thead>
	    <tr>
	      <td class="text-left required">Значение опции</td>
	      <td class="text-center">Изображение</td>
	      <td class="text-right">Порядок сортировки</td>
	      <td></td>
	    </tr>
	  </thead>
	  <tbody>
              
      <tr id="option-value-row0">
<td class="text-center"><input type="hidden" name="option_value[0][option_value_id]" value="23">
                    <div class="input-group"><span class="input-group-addon"><img src="language/ru-ru/ru-ru.png" title="Русский"></span>
    <input type="text" name="option_value[0][option_value_description][2][name]" value="Checkbox 1" placeholder="Значение опции" class="form-control">
  </div>
                                    </td>
                <td class="text-left"><a href="" id="thumb-image0" data-toggle="image" class="img-thumbnail"><img src="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png" alt="" title="" data-placeholder="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png"></a>
                  <input type="hidden" name="option_value[0][image]" value="" id="input-image0"></td>
                <td class="text-right"><input type="text" name="option_value[0][sort_order]" value="1" class="form-control"></td>
                <td class="text-right"><button type="button" onclick="$('#option-value-row0').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Удалить"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
                                          <tr id="option-value-row1">
                <td class="text-center"><input type="hidden" name="option_value[1][option_value_id]" value="24">
                                    <div class="input-group"><span class="input-group-addon"><img src="language/ru-ru/ru-ru.png" title="Русский"></span>
                    <input type="text" name="option_value[1][option_value_description][2][name]" value="Checkbox 2" placeholder="Значение опции" class="form-control">
                  </div>
                                    </td>
                <td class="text-left"><a href="" id="thumb-image1" data-toggle="image" class="img-thumbnail"><img src="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png" alt="" title="" data-placeholder="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png"></a>
                  <input type="hidden" name="option_value[1][image]" value="" id="input-image1"></td>
                <td class="text-right"><input type="text" name="option_value[1][sort_order]" value="2" class="form-control"></td>
                <td class="text-right"><button type="button" onclick="$('#option-value-row1').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Удалить"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
                                          <tr id="option-value-row2">
                <td class="text-center"><input type="hidden" name="option_value[2][option_value_id]" value="44">
                                    <div class="input-group"><span class="input-group-addon"><img src="language/ru-ru/ru-ru.png" title="Русский"></span>
                    <input type="text" name="option_value[2][option_value_description][2][name]" value="Checkbox 3" placeholder="Значение опции" class="form-control">
                  </div>
                                    </td>
                <td class="text-left"><a href="" id="thumb-image2" data-toggle="image" class="img-thumbnail"><img src="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png" alt="" title="" data-placeholder="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png"></a>
                  <input type="hidden" name="option_value[2][image]" value="" id="input-image2"></td>
                <td class="text-right"><input type="text" name="option_value[2][sort_order]" value="3" class="form-control"></td>
                <td class="text-right"><button type="button" onclick="$('#option-value-row2').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Удалить"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
                                          <tr id="option-value-row3">
                <td class="text-center"><input type="hidden" name="option_value[3][option_value_id]" value="45">
                                    <div class="input-group"><span class="input-group-addon"><img src="language/ru-ru/ru-ru.png" title="Русский"></span>
                    <input type="text" name="option_value[3][option_value_description][2][name]" value="Checkbox 4" placeholder="Значение опции" class="form-control">
                  </div>
                                    </td>
                <td class="text-left"><a href="" id="thumb-image3" data-toggle="image" class="img-thumbnail"><img src="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png" alt="" title="" data-placeholder="http://local.aqua-home.com.ua/image/cache/no_image-100x100.png"></a>
                  <input type="hidden" name="option_value[3][image]" value="" id="input-image3"></td>
                <td class="text-right"><input type="text" name="option_value[3][sort_order]" value="4" class="form-control"></td>
                <td class="text-right"><button type="button" onclick="$('#option-value-row3').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Удалить"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
                                            </tbody>
              
              <tfoot>
                <tr>
                  <td colspan="3"></td>
                  <td class="text-right"><button type="button" onclick="addOptionValue();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Добавить"><i class="fa fa-plus-circle"></i></button></td>
                </tr>
              </tfoot>
            </table>
          </fieldset>
-->
<input class="btn btn-primary" type="submit" value="Сохранить">