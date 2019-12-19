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

          <label for="">Название для языкового пакета {{$lang_select->name}}</label>
          <input type="text" class="form-control" name="name{{$lang_select->id}}" placeholder="Название для языкового пакета {{$lang_select->name}}" 
          @if (isset($product->product_id)) 
          @foreach ($choose_product_description as $product_description_select)
          @if ($product_description_select->language_id == $lang_select->id)
          value="{{$product_description_select->name}}"
          @endif
          @endforeach @else value="" @endif required>

          <label for="">Описание для языкового пакета {{$lang_select->name}}</label>
          <input type="text" class="form-control" name="description{{$lang_select->id}}" placeholder="Описание для языкового пакета {{$lang_select->name}}" 
          @if (isset($product->product_id)) 
          @foreach ($choose_product_description as $product_description_select)
          @if ($product_description_select->language_id == $lang_select->id)
          value="{{$product_description_select->description}}"
          @endif
          @endforeach @else value="" @endif required>

          <label for="">Мета-тег Description для языкового пакета {{$lang_select->name}}</label>
          <input type="text" class="form-control" name="meta_description{{$lang_select->id}}" placeholder="Мета-тег Description для языкового пакета {{$lang_select->name}}" 
          @if (isset($product->product_id)) 
          @foreach ($choose_product_description as $product_description_select)
          @if ($product_description_select->language_id == $lang_select->id)
          value="{{$product_description_select->meta_description}}"
          @endif
          @endforeach @else value="" @endif required>

          <label for="">Мета-тег Keyword для языкового пакета {{$lang_select->name}}</label>
          <input type="text" class="form-control" name="meta_keyword{{$lang_select->id}}" placeholder="Мета-тег Keyword для языкового пакета {{$lang_select->name}}"  
          @if (isset($product->product_id)) 
          @foreach ($choose_product_description as $product_description_select)
          @if ($product_description_select->language_id == $lang_select->id)
          value="{{$product_description_select->meta_keyword}}"
          @endif
          @endforeach @else value="" @endif required>

           <label for="">Теги товара (через запятую) для языкового пакета {{$lang_select->name}}</label>
          <input type="text" class="form-control" name="tag{{$lang_select->id}}" placeholder="Теги товара для языкового пакета {{$lang_select->name}}" 
          @if (isset($product->product_id)) 
          @foreach ($choose_product_description as $product_description_select)
          @if ($product_description_select->language_id == $lang_select->id)
          value="{{$product_description_select->tag}}"
          @endif
          @endforeach @else value="" @endif required>

        
      </div>
      @endforeach
      <!--<div id="en" class="tab-pane fade">
        <h3>English</h3>
      </div>
      <div id="lv" class="tab-pane fade">
        <h3>Latviešu</h3>
      </div>
      <div id="et" class="tab-pane fade">
        <h3>Eesti</h3>
      </div>
      <div id="lt" class="tab-pane fade">
        <h3>Lietuvių</h3>
      </div>-->
    </div>
 <!--protected $fillable = ['product_id', 'language_id', 'name', 'description', 'meta_description', 'meta_keyword', 'tag',];-->
  </div>
  <div id="panel2" class="tab-pane fade">
    <h3>Данные</h3>
    <label for="">Модель</label>
    <input type="text" class="form-control" name="model" placeholder="Модель" 
    @if (isset($product->product_id)) 
    @foreach ($choose_product as $product_select)
    value="{{$product_select->model}}"
    @endforeach @else value="" @endif required>


    <label for="">Артикул</label>
    <input type="text" class="form-control" name="sku" placeholder="Артикул" 
    @if (isset($product->product_id)) 
    @foreach ($choose_product as $product_select)
    value="{{$product_select->sku}}"
    @endforeach @else value="" @endif required>

    <label for="">Количество</label>
    <input type="text" class="form-control" name="quantity" placeholder="Количество" 
    @if (isset($product->product_id)) 
    @foreach ($choose_product as $product_select)
    value="{{$product_select->quantity}}"
    @endforeach @else value="" @endif required>

    <label for="">Цена</label>
    <input type="text" class="form-control" name="price" placeholder="Цена" 
    @if (isset($product->product_id)) 
    @foreach ($choose_product as $product_select)
    value="{{$product_select->price}}"
    @endforeach @else value="" @endif required>


    @if (isset($product->product_id)) 
    <input type="hidden" name="product_id" value="{{$product->product_id}}">
    @else
    <input type="hidden" name="category_id" value="0">
    @endif
  </div>
  <div id="panel3" class="tab-pane fade">
    <h3>Связи</h3>

    <label for="">Категория</label>
    <select class="form-control" name="category_id">
      <option value="0">-- без родительской категории --</option>
      @include('admin.products.partials.categories', ['categories' => $categories, 'product' => $product])
    </select>
    
    <label for="">Производитель</label>
    <select class="form-control" name="manufacturer_id">
      <option value="0">-- не выбрано --</option>
      @include('admin.products.partials.manufacturers', ['manufacturers' => $manufacturers, 'product' => $product])
    </select>
  </div>

  <!-- Атрибуты -->
  <div id="panel4" class="tab-pane fade">
    <h3>Атрибуты</h3>
    <div class="table-responsive">
      <table id="attribute" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <td class="text-left">Атрибут</td>
            <td class="text-left">Текст</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <!--1 Только что созданный - create -->
          <!--2 Отредактирована - update -->
          <!--3 Удалена - delete -->
          @php ($attribute_row = 1)
          @if (isset($product_attributes)) 
            @php ($count_attribute = 0)
          
            @foreach ($choose_product_attributes as $product_attribute)
              @if ($product_attribute->attribute_id == $count_attribute) 
              <!--Повтор-->
              @else
                <input type="hidden" id="attribute_active{{ $attribute_row }}" name="attribute_active{{ $attribute_row }}" value="2"> 
                <input type="hidden" id="attribute_id{{ $attribute_row }}" name="attribute_id{{ $attribute_row }}" value="{{$product_attribute->attribute_id}}">
                <tr id="attribute-row{{ $attribute_row }}">
                  <td class="text-left" style="width: 40%;">
                    <select class="form-control" name="product_attribute{{$attribute_row}}">
                      <option value="0"> -- не выбрано -- </option>
                        @include('admin.products.partials.attributes', ['attribute_descriptions' => $attribute_descriptions, 'product_attribute' => $product_attribute])
                    </select>
                  </td>
                  <td class="text-left">
                    @foreach ($languages as $language)
                      @foreach ($product_attributes as $product_select)
                        @if ($product_select->language_id == $language->id && $product_select->attribute_id == $product_attribute->attribute_id) 
                        <div class="input-group"><span class="input-group-addon">{{$language->name}}</span>
                          <textarea name="product_attribute{{$attribute_row}}[product_attribute_text{{$language->id}}]" rows="5" placeholder="{{ $language->name }}" class="form-control">{{$product_select->text}}</textarea> 
                        </div>
                        @endif
                      @endforeach
                    @endforeach
                  </td>
                  <td class="text-right"><button type="button" onclick="removeAttributes({{ $attribute_row }}); " data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                  </td>
                </tr>
                @php ($attribute_row = $attribute_row + 1)
              @endif
            @endforeach
          @else
            <!-- NOT FOUND ATTRIBUTES -->
          @endif
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td class="text-right"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Добавить"><i class="fa fa-plus-circle"></i></button></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <input type="hidden" id="attribute_row_count" name="attribute_row_count" value="">
  </div>

  <!-- Опции -->
  <div id="panel5" class="tab-pane fade">
    <div class="row">
      <div class="col-sm-2">
        <ul class="nav nav-pills nav-stacked" id="option">
          @php ($option_row = 1)
          @if (isset($product_options)) 
          @foreach ($product_options as $product_option)
         
            <!--<li>
              <a href="#tab-option{{ $option_row }}" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-option{{ $option_row }}\']').parent().remove(); $('#tab-option{{ $option_row }}').remove(); $('#option a:first').tab('show');"></i> {{ $product_option['name'] }}</a></li>-->
             <li><a href="#tab-option{{ $option_row }}" data-toggle="tab"><i class="fa fa-minus-circle" onclick="removeOptions({{ $option_row }});"></i> {{ $product_option['name'] }}</a></li>

              
            @php ($option_row = $option_row + 1)
          @endforeach
          @else
            <!--Not Found product_options -->
          @endif
          <li>
            <!--<input type="text" name="option" onchange="getOptions()" value="Размер" placeholder="Введите название опции" id="input-option" class="form-control"/>-->
            <input type="text" name="option" value="" placeholder="Введите название опции" id="input-option" class="form-control"/>
          </li>
        </ul>
      </div>
     <div class="col-sm-10">
      <div class="tab-content"> 
        @php ($option_row = 1)
        @php ($option_value_row = 1)
        @if (isset($product_options)) 
        @foreach ($product_options as $product_option)
        <input type="hidden" name="product_option{{ $option_row }}[active]" id="option_value_active{{ $option_row }}" value="2"/>;
        <input type="hidden" name="product_option{{ $option_row }}[option_id]" value="{{ $product_option['option_id'] }}"/>
        <input type="hidden" name="product_option{{ $option_row }}[product_option_id]" value="{{ $product_option['product_option_id'] }}"/>  
          <div class="tab-pane" id="tab-option{{ $option_row }}">
           
            <input type="hidden" name="product_option{{ $option_row }}[name]" value="{{ $product_option['name'] }}"/> 
            
            <input type="hidden" name="product_option{{ $option_row }}[type]" value="{{ $product_option['type'] }}"/>
            <!--<input type="hidden" name="product_option{{ $option_row }}[active]" id="option_value_active{{ $option_row }}" value="2">;-->

            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-required{{ $option_row }}">Обязателен</label>
              <div class="col-sm-10">
                <select name="product_option{{ $option_row }}[required]" id="input-required{{ $option_row }}" class="form-control">
                  @if ($product_option['required'] == 1)
                    <option value="1" selected="selected">Да</option>
                    <option value="0">Нет</option>
                  @else
                    <option value="1">Да</option>
                    <option value="0" selected="selected">Нет</option>
                  @endif
                </select>
              </div>
            </div>
            
            @if ($product_option['type'] == 'text')
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-value{{ $option_row }}">Значение опции</label>
                <div class="col-sm-10">
                  <input type="hidden" id="option_value_active{{ $option_row }}" name="product_option{{ $option_row }}[active]" value="2"/>;

                  <input type="text" name="product_option{{ $option_row }}[value]" value="{{ $product_option['value'] }}" placeholder="Значение опции" id="input-value{{ $option_row }}" class="form-control"/>
                </div>
              </div>
            @endif
            @if ($product_option['type'] == 'textarea')
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-value{{ $option_row }}">Значение опции</label>
                <div class="col-sm-10">
                  <input type="hidden" id="option_value_active{{ $option_row }}" name="product_option{{ $option_row }}[active]" value="2"/>;
                  <textarea name="product_option{{ $option_row }}[value]" rows="5" placeholder="Значение опции" id="input-value{{ $option_row }}" class="form-control">{{ $product_option['value'] }}</textarea>
                </div>
              </div>
            @endif
            
            @if ($product_option['type'] == 'select' or $product_option['type'] == 'radio' or $product_option['type'] == 'checkbox')
              <div class="table-responsive">
                <table id="option-value{{ $option_row }}" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left"> Значение опции </td>';
                      <td class="text-right"> Количество </td>';
                      <td class="text-left"> Вычитать со склада </td>';
                      <td class="text-right"> Цена </td>';
                      <td class="text-right"> Баллы </td>';
                      <td class="text-right"> Вес </td>';
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($product_option['product_option_value'] as $product_option_value)
                    <input type="hidden" id="option_values_active{{ $option_value_row }}" name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][active]" value="2"/>;
                    <input type="hidden" name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][product_option_value_id]" value="{{ $product_option_value['product_option_value_id'] }}"/>

                    <tr id="option-value-row{{ $option_value_row }}">
                      <td class="text-left">
                        <select name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][option_value_id]" class="form-control">
                          @if ($option_values[$product_option['option_id']] )
                            @foreach ($option_values[$product_option['option_id']] as $option_value )
                              @if ($option_value['option_value_id'] == $product_option_value['option_value_id'])
                                <option value="{{ $option_value['option_value_id'] }}" selected="selected">{{ $option_value['name'] }}</option>
                              @else
                                <option value="{{ $option_value['option_value_id'] }}">{{ $option_value['name'] }}</option>
                              @endif
                            @endforeach
                          @endif
                        </select> 
                      </td>
                      <td class="text-right">
                        <input type="text" name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][quantity]" value="{{ $product_option_value['quantity'] }}" placeholder="Колличество" class="form-control"/>
                      </td>
                      <td class="text-left"><select name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][subtract]" class="form-control">
                          @if ($product_option_value['subtract'])
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                          @else
                            <option value="1">Да</option>
                            <option value="0" selected="selected">Нет</option>
                          @endif
                        </select>
                      </td>
                      <td class="text-right">
                        <select name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][price_prefix]" class="form-control">
                          @if ($product_option_value['price_prefix'] == '+')
                            <option value="+" selected="selected">+</option>
                          @else
                            <option value="+">+</option>
                          @endif
                          @if ($product_option_value['price_prefix'] == '-')
                            <option value="-" selected="selected">-</option>
                          @else
                            <option value="-">-</option>
                          @endif
                        </select> 
                        <input type="text" name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][price]" value="{{ $product_option_value['price'] }}" placeholder="Цена" class="form-control"/>
                      </td>
                      <td class="text-right">
                        <select name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][points_prefix]" class="form-control">
                          @if ($product_option_value['points_prefix'] == '+')
                            <option value="+" selected="selected">+</option>
                          @else
                            <option value="+">+</option>
                          @endif
                          @if ($product_option_value['points_prefix'] == '-')
                            <option value="-" selected="selected">-</option>
                          @else
                            <option value="-">-</option>
                          @endif
                        </select> 
                        <input type="text" name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][points]" value="{{ $product_option_value['points'] }}" placeholder="Баллы" class="form-control"/>
                      </td>
                      <td class="text-right"><select name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][weight_prefix]" class="form-control">
                          @if ($product_option_value['weight_prefix'] == '+')
                            <option value="+" selected="selected">+</option>
                          @else
                            <option value="+">+</option>
                          @endif
                          @if ($product_option_value['weight_prefix'] == '-')
                            <option value="-" selected="selected">-</option>
                          @else
                            <option value="-">-</option>
                          @endif
                        </select>
                        <input type="text" name="product_option{{ $option_row }}[product_option_value][{{ $option_value_row }}][weight]" value="{{ $product_option_value['weight'] }}" placeholder="Вес" class="form-control"/>
                      </td>
                      <td class="text-right">
                        <button type="button" onclick="
                          $(this).tooltip('destroy');$('#option-value-row{{ $option_value_row }}').remove();document.getElementById('option_values_active{{ $option_value_row }}').value = 3;" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i>
                        </button>
                      </td>
                    </tr>
                      @php ($option_value_row = $option_value_row + 1)
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="6"></td>
                      <td class="text-left"><button type="button" onclick="addOptionValue('{{ $option_row }}');" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div> 
              <select id="option-values{{ $option_row }}" style="display: none;">
            @if ($option_values[$product_option['option_id']])
              @foreach ($option_values[$product_option['option_id']] as $option_value)
                <option value="{{ $option_value['option_value_id'] }}">{{ $option_value['name'] }}</option>
              @endforeach
            @endif
          </select>
            @endif
              </div> 
          
          @php ($option_row = $option_row + 1)
        @endforeach
        @else
          <!--Not Found product_options -->
        @endif
        
    </div> 
    <input type="hidden" name="option_row_count" id="option_row_count" value="{{ $option_row }}"/>;
    <input type="hidden" name="option_value_row_count" id="option_value_row_count" value="{{ $option_value_row }}"/>;

  </div>
    </div> 

<script type="text/javascript"><!--

// Autocomplete */


window.onload = function()
{
   


(function($) {
  $.fn.autocomplete = function(option) {
    return this.each(function() {
      var $this = $(this);
      var $dropdown = $('<ul class="dropdown-menu" />');

      this.timer = null;
      this.items = [];

      $.extend(this, option);

      $this.attr('autocomplete', 'off');

      // Focus
      $this.on('focus', function() {
        this.request();
      });

      // Blur
      $this.on('blur', function() {
        setTimeout(function(object) {
          object.hide();
        }, 200, this);
      });

      // Keydown
      $this.on('keydown', function(event) {
        switch(event.keyCode) {
          case 27: // escape
            this.hide();
            break;
          default:
            this.request();
            break;
        }
      });

      // Click
      this.click = function(event) {
        event.preventDefault();

        var value = $(event.target).parent().attr('data-value');

        if (value && this.items[value]) {
          this.select(this.items[value]);
        }
      }

      // Show
      this.show = function() {
        var pos = $this.position();

        $dropdown.css({
          top: pos.top + $this.outerHeight(),
          left: pos.left
        });

        $dropdown.show();
      }

      // Hide
      this.hide = function() {
        $dropdown.hide();
      }

      // Request
      this.request = function() {
        clearTimeout(this.timer);

        this.timer = setTimeout(function(object) {
          object.source($(object).val(), $.proxy(object.response, object));
        }, 200, this);
      }

      // Response
      this.response = function(json) {
        var html = '';
        var category = {};
        var name;
        var i = 0, j = 0;

        if (json.length) {
          for (i = 0; i < json.length; i++) {
            // update element items
            this.items[json[i]['value']] = json[i];

            if (!json[i]['category']) {
              // ungrouped items
              html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
            } else {
              // grouped items
              name = json[i]['category'];
              if (!category[name]) {
                category[name] = [];
              }

              category[name].push(json[i]);
            }
          }

          for (name in category) {
            html += '<li class="dropdown-header">' + name + '</li>';

            for (j = 0; j < category[name].length; j++) {
              html += '<li data-value="' + category[name][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[name][j]['label'] + '</a></li>';
            }
          }
        }

        if (html) {
          this.show();
        } else {
          this.hide();
        }

        $dropdown.html(html);
      }

      $dropdown.on('click', '> li > a', $.proxy(this.click, this));
      $this.after($dropdown);
    });
  }
})(window.jQuery);

}

/******/
   //--></script> 
<script type="text/javascript"><!--
var option_row = {{ $option_row }};

function removeOptions(option_row) {
  var option_row = option_row;
  $('a[href=\'#tab-option'+ option_row + '\']').parent().remove();
  $('#tab-option'+ option_row + '').remove();
  $('#option_row' + option_row + '').remove();
  $('#option a:first').tab('show');

  document.getElementById("option_value_active" + option_row + '').value = 3;


/*onclick="$('a[href=\'#tab-option{{ $option_row }}\']').parent().remove(); $('#tab-option{{ $option_row }}').remove(); $('#option a:first').tab('show');"*/


}



function checkCountOptions() {
    console.log('Check');
    var option_row_count = document.getElementById("option_row_count");
    option_row_count.value = option_row;
  }
  setInterval(checkCountOptions, 1000);

/*$('#input-option').on("input",function(ev){
  console.log($(ev.target).val());
});*/

/*
var input = document.getElementById("input-option");

  input.oninput = function() {
    //document.getElementById('result').innerHTML = input.value;
    console.log(input.innerHTML);
    console.log('11');
  };
*/
/*
$(document).on('click', '#input-option', function(){
  $('#input-option').autocomplete({

    'source': function(request, response) {
       console.log('autocomplete');
      $.ajax({
       // url: '/admin/autocomplete&filter_name=' + encodeURIComponent(request)',
        url: '/admin/autocomplete/' + request,
        dataType: 'json',
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(json) {
          console.log('success');
          console.log(json);
          response($.map(json, function(item) {
            return {
              category: item['category'],
              label: item['name'],
              value: item['option_id'],
              type: item['type'],
              option_value: item['option_value']
            }
          }));
        }
      });
    },
  });
});*/


function getOptions() {
  var input = document.getElementById("input-option");
  //console.log(input);
  $('#input-option').autocomplete({

    'source': function(request, response) {
       console.log('autocomplete');
      $.ajax({
       // url: '/admin/autocomplete&filter_name=' + encodeURIComponent(request)',
        url: '/admin/autocomplete/' + request,
        dataType: 'json',
        headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(json) {
          console.log('success');
          console.log(json);
          response($.map(json, function(item) {
            return {
              category: item['category'],
              label: item['name'],
              value: item['option_id'],
              type: item['type'],
              option_value: item['option_value']
            }
          }));
        }
      });
    },
  });
}

 /* $('input[name=\'option\'][0]').autocomplete({*/
  $(document).on('click', '#input-option', function(){
     $('#input-option').autocomplete({
    'source': function(request, response) {
      $.ajax({
       // url: '/admin/autocomplete&filter_name=' + encodeURIComponent(request)',
        url: '/admin/autocomplete/' + request,
        dataType: 'json',
        /*headers: {
          'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },*/
        success: function(json) {
          console.log('response');
          response($.map(json, function(item) {
            return {
              category: item['category'],
              label: item['name'],
              value: item['option_id'],
              type: item['type'],
              option_value: item['option_value'],

            } 
          }));

        }
      });
    },
    'select': function(item) {
      html = '<div class="tab-pane" id="tab-option' + option_row + '">';
      html += ' <input type="hidden" name="product_option' + option_row + '[product_option_id]" value="" />';
      html += ' <input type="hidden" name="product_option' + option_row + '[name]" value="' + item['label'] + '" />';
      html += ' <input type="hidden" name="product_option' + option_row + '[option_id]" value="' + item['value'] + '" />';
      html += ' <input type="hidden" name="product_option' + option_row + '[type]" value="' + item['type'] + '" />';
      html += ' <input type="hidden" name="product_option' + option_row + '[active]" id="option_value_active' + option_row + '" value="1" />';
      

      html += ' <div class="form-group">';
      html += '   <label class="col-sm-2 control-label" for="input-required' + option_row + '"> Обязателен </label>';
      html += '   <div class="col-sm-10"><select name="product_option' + option_row + '[required]" id="input-required' + option_row + '" class="form-control">';
      html += '       <option value="1"> Да </option>';
      html += '       <option value="0"> Нет </option>';
      html += '   </select></div>';
      html += ' </div>';

      if (item['type'] == 'text') {
        html += ' <div class="form-group">';
        html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '"> Значение опции </label>';
        html += '   <input type="hidden" name="product_option' + option_row + '[active]" value="1" id="option_value_active' + option_row + '" >';
        html += '   <div class="col-sm-10"><input type="text" name="product_option' + option_row + '[value]" value="" placeholder=" Значение опции " id="input-value' + option_row + '" class="form-control" /></div>';
        html += ' </div>';
      }

      if (item['type'] == 'textarea') {
        html += ' <div class="form-group">';
        html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '"> Значение опции </label>';
        html += '   <input type="hidden" name="product_option' + option_row + '[active]" value="1" id="option_value_active' + option_row + '" >';
        html += '   <div class="col-sm-10"><textarea name="product_option' + option_row + '[value]" rows="5" placeholder=" Значение опции " id="input-value' + option_row + '" class="form-control"></textarea></div>';
        html += ' </div>';
      }

      if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox') {
        html += '<div class="table-responsive">';
        html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
        html += '    <thead>';
        html += '      <tr>';
        html += '        <td class="text-left"> Значение опции </td>';
        html += '        <td class="text-right"> Количество </td>';
        html += '        <td class="text-left"> Вычитать со склада </td>';
        html += '        <td class="text-right"> Цена </td>';
        html += '        <td class="text-right"> Баллы </td>';
        html += '        <td class="text-right"> Вес </td>';
        html += '        <td></td>';
        html += '      </tr>';
        html += '    </thead>';
        html += '    <tbody>';
        html += '    </tbody>';
        html += '    <tfoot>';
        html += '      <tr>';
        html += '        <td colspan="6"></td>';
        html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
        html += '      </tr>';
        html += '    </tfoot>';
        html += '  </table>';
        html += '</div>';

        html += '  <select id="option-values' + option_row + '" style="display: none;">';


        for (i = 0; i < item['option_value'].length; i++) {
          html += '  <option value="' + item['option_value'][i]['option_value_id'] + '">' + item['option_value'][i]['name'] + '</option>';
        }

        html += '  </select>';
        html += '</div>';
      }

      $('#panel5 .tab-content').append(html);

      $('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick=" $(\'#option a:first\').tab(\'show\');$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove();"></i>' + item['label'] + '</li>');

      $('#option a[href=\'#panel5' + option_row + '\']').tab('show');

      $('[data-toggle=\'tooltip\']').tooltip({
        container: 'body',
        html: true
      });

     

      option_row++;
    } 
  });
});
  //--></script>

  <script type="text/javascript"><!--
  var option_value_row = {{ $option_value_row }};

  function checkCountValueOptions() {
    //console.log('Check');
    var option_value_row_count = document.getElementById("option_value_row_count");
    option_value_row_count.value = option_value_row;
    
  }
  setInterval(checkCountValueOptions, 1000);

  function addOptionValue(option_row) {
    
    
    html = '<tr id="option-value-row' + option_value_row + '">';
    html += '  <td class="text-left"><select name="product_option' + option_row + '[product_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
    html += $('#option-values' + option_row).html();
    html += '  </select><input type="hidden" name="product_option' + option_row + '[product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_option' + option_row + '[product_option_value][' + option_value_row + '][quantity]" value="" placeholder="Количество" class="form-control" /></td>';
    html += '  <td class="text-left"><select name="product_option' + option_row + '[product_option_value][' + option_value_row + '][subtract]" class="form-control">';
    html += '    <option value="1">Да</option>';
    html += '    <option value="0">Нет</option>';
    html += '  </select></td>';
    html += '  <td class="text-right"><select name="product_option' + option_row + '[product_option_value][' + option_value_row + '][price_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="text" name="product_option' + option_row + '[product_option_value][' + option_value_row + '][price]" value="" placeholder="Цена" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="product_option' + option_row + '[product_option_value][' + option_value_row + '][points_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="text" name="product_option' + option_row + '[product_option_value][' + option_value_row + '][points]" value="" placeholder="Баллы" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="product_option' + option_row + '[product_option_value][' + option_value_row + '][weight_prefix]" class="form-control">';
    html += '    <option value="+">+</option>';
    html += '    <option value="-">-</option>';
    html += '  </select>';
    html += '  <input type="text" name="product_option' + option_row + '[product_option_value][' + option_value_row + '][weight]" value="" placeholder="Вес" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    html += '<input type="hidden" id="option_value_active' + option_value_row + '" name="product_option' + option_row + '[product_option_value][' + option_value_row + '][active]" value="1"/>';



    $('#option-value' + option_row + ' tbody').append(html);
    $('[rel=tooltip]').tooltip();

    option_value_row++;
  }

  //--></script>
  </div>

  <!-- Изображения -->
  <div id="panel6" class="tab-pane fade">
    <h3>Изображения</h3>
    <div class="tab-pane" id="tab-image">
      <div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <td class="text-left">Изображение</td>
              <td class="text-right">Порядок сортировки</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @php ($image_row = 1)
            @if (isset($product_images)) 
            @foreach ($product_images as $product_image)
            <input type="hidden" id="image_active{{ $image_row }}" name="image_active{{ $image_row }}" value="1">
            <input type="hidden" id="product_image_id{{ $image_row }}" name="product_image_id{{ $image_row }}" value="{{$product_image->product_image_id}}">

              <tr id="image-row{{ $image_row }}">
                <td class="text-left">
                  <img src="{{asset('/storage/' . $product_image->image) }}"  style="width: 20%;" alt="" title="" data-placeholder="Изображение"/>
                  <input type="hidden" name="product_image{{ $image_row }}[image]" value="{{ $product_image->image }}" id="input-image{{ $image_row }}"/></td>
                <td class="text-right"><input type="text" name="product_image{{ $image_row }}[sort_order]" value="{{ $product_image->sort_order }}" placeholder="Введите порядок сортировки" class="form-control"/></td>
                <td class="text-left"><button type="button" onclick="removeImages({{ $image_row }}); " data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
              </tr>
              @php ($image_row = $image_row + 1)
            @endforeach
            @else
            <!--Not Found Images -->
            @endif
          </tbody>

          <tfoot>
            <tr>
              <td colspan="2"></td>
              <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Добавить изображение" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <input type="hidden" id="image_row_count" name="image_row_count" value="">
  </div>

<div id="panel7" class="tab-pane fade">
    <div class="table-responsive">
                <table id="discount" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Группа клиентов</td>
                      <td class="text-right">Количество</td>
                      <td class="text-right">Приоритет</td>
                      <td class="text-right">Цена</td>
                      <td class="text-left">Дата начала</td>
                      <td class="text-left">Дата окончания</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    @php ($discount_row = 1)
                      @if (isset($choose_discounts))
                        @foreach ($choose_discounts as $choose_discount)
                        <input type="hidden" id="discount_active{{ $discount_row }}" name="product_discount{{ $discount_row }}[active]" value="2">;
                        <input type="hidden" id="discount_id{{ $discount_row }}" name="product_discount{{ $discount_row }}[product_discount_id]" value="{{ $choose_discount->product_discount_id }}">
                          <tr id="discount-row{{ $discount_row }}">
                            <td class="text-left"><select name="product_discount{{ $discount_row }}[customer_group_id]" class="form-control">
                              @foreach ($customer_groups as $customer_group)
                                
                                  @if ($customer_group->customer_group_id == $choose_discount->customer_group_id)
                                    <option value="{{ $customer_group->customer_group_id }}" selected="selected">{{ $customer_group->name }}</option>
                                  @else
                                    <option value="{{ $customer_group->customer_group_id }}">{{ $customer_group->name }}</option>
                                  @endif
                              @endforeach
                               
                              </select></td>
                            <td class="text-right"><input type="text" name="product_discount{{ $discount_row }}[quantity]" value="{{ $choose_discount->quantity }}" placeholder="Введите количество" class="form-control"/></td>
                            <td class="text-right"><input type="text" name="product_discount{{ $discount_row }}[priority]" value="{{ $choose_discount->priority }}" placeholder="Введите порядок сортировки" class="form-control"/></td>
                            <td class="text-right"><input type="text" name="product_discount{{ $discount_row }}[price]" value="{{ $choose_discount->price }}" placeholder="Введите цену" class="form-control"/></td>
                            <td class="text-left" style="width: 20%;">
                              <div class="input-group date">
                                <input type="date" name="product_discount{{ $discount_row }}[date_start]" value="{{ $choose_discount->date_start }}" placeholder="Введите дату начала" data-date-format="DD.MM.YYYY" class="form-control"/> 
                              </div>
                            </td>
                            <td class="text-left" style="width: 20%;">
                              <div class="input-group date">
                                <input type="date" name="product_discount{{ $discount_row }}[date_end]" value="{{$choose_discount->date_end }}" placeholder="Введите Дату окончания" data-date-format="DD.MM.YYYY" class="datepicker  form-control"/>
                              </div>
                            </td>
                            <td class="text-left"><button type="button" onclick="removeDiscounts({{ $discount_row }});" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                          </tr>
                          @php ($discount_row = $discount_row + 1)
                        @endforeach
                      @else
                        <!-- NOT FOUND ATTRIBUTES -->
                      @endif
                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan="6"></td>
                      <td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="Добавить скидку" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <input type="hidden" id="discount_row_count" name="discount_row_count" value="">
</div>
            <div id="panel8" class="tab-pane fade">
              <div class="table-responsive">
                <table id="special" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Группа клиентов</td>
                      <td class="text-right">Приоритет</td>
                      <td class="text-right">Цена</td>
                      <td class="text-left">Дата начала</td>
                      <td class="text-left">Дата окончания</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                    @php ($special_row = 1)
                      @if (isset($choose_specials))
                        @foreach ($choose_specials as $choose_special)
                        <input type="hidden" id="special_active{{ $special_row }}" name="product_special{{ $special_row }}[active]" value="2">;
                        <input type="hidden" id="special_id{{ $special_row }}" name="product_special{{ $special_row }}[product_special_id]" value="{{ $choose_special->product_special_id }}">
                        <tr id="special-row{{ $special_row }}">
                          <td class="text-left">
                            <select name="product_special{{ $special_row }}[customer_group_id]" class="form-control">
                            @foreach ($customer_groups as $customer_group)
                              @if ($customer_group->customer_group_id == $choose_special->customer_group_id)
                                <option value="{{ $customer_group->customer_group_id }}" selected="selected">{{ $customer_group->name }}</option>
                              @else
                                <option value="{{ $customer_group->customer_group_id }}">{{ $customer_group->name }}</option>
                              @endif
                            @endforeach
                            </select>
                          </td>
                          <td class="text-right">
                            <input type="text" name="product_special{{ $special_row }}[priority]" value="{{ $choose_special->priority }}" placeholder="Введите порядок сортировки" class="form-control"/>
                          </td>
                          <td class="text-right">
                            <input type="text" name="product_special{{ $special_row }}[price]" value="{{ $choose_special->price }}" placeholder="Введите цену" class="form-control"/>
                          </td>
                          <td class="text-left" style="width: 20%;">
                            <div class="input-group date">
                              <input type="date" name="product_special{{ $special_row }}[date_start]" value="{{ $choose_special->date_start }}" placeholder="Введите дату начала" data-date-format="DD.MM.YYYY" class="form-control"/> 
                              
                            </div>
                          </td>
                          <td class="text-left" style="width: 20%;">
                            <div class="input-group date">
                              <input type="date" name="product_special{{ $special_row }}[date_end]" value="{{ $choose_special->date_end }}" placeholder="Введите дату окончания" data-date-format="DD.MM.YYYY" class="form-control"/> 
                              
                            </div>
                          </td>
                          <td class="text-left">
                            <button type="button" onclick="removeSpecials({{ $special_row }});" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                          </td>
                        </tr>
                      @php ($special_row = $special_row + 1)
                        @endforeach
                      @else
                        <!-- NOT FOUND SPECIAL -->
                      @endif
                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                      <td class="text-left"><button type="button" onclick="addSpecial();" data-toggle="tooltip" title="Добавить" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <input type="hidden" id="special_row_count" name="special_row_count" value="">
            </div>
<script type="text/javascript"><!--
  


  function removeSpecials(special_row) {
  var spec_row = special_row;
  $('#special-row' + spec_row + '').remove();
  document.getElementById("special_active" + spec_row + '').value = 3;
}

  var special_row = {{ $special_row }};

function checkCountSpecials() {
    //console.log('Check');
    var special_row_count = document.getElementById("special_row_count");
    special_row_count.value = special_row;
  }
  setInterval(checkCountSpecials, 1000);

  function addSpecial() {
    html = '<tr id="special-row' + special_row + '">';
    html += '  <td class="text-left"><select name="product_special' + special_row + '[customer_group_id]" class="form-control">';
    @foreach ($customer_groups as $customer_group)
    html += '      <option value="{{ $customer_group->customer_group_id }}">{{ $customer_group->name }}</option>';
    @endforeach
    html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_special' + special_row + '[priority]" value="" placeholder="Введите порядок сортировки" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_special' + special_row + '[price]" value="" placeholder="Введите цену" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="date" name="product_special' + special_row + '[date_start]" value="" placeholder="Введите дату начала" data-date-format="DD.MM.YYYY" class="form-control" /></div></td>';

    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="date" name="product_special' + special_row + '[date_end]" value="" placeholder="Введите дату окончания" data-date-format="DD.MM.YYYY" class="form-control" /></div></td>';
    html += '  <td class="text-left"><button type="button" onclick="removeSpecials(' + special_row + ');" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    html += '<input type="hidden" id="special_active' + special_row + '" name="product_special' + special_row + '[active]" value="1">';
    $('#special tbody').append(html);

    special_row++;
  }

  //--></script>
<script type="text/javascript"><!--

function removeDiscounts(discount_row) {
  var disc_row = discount_row;
  $('#discount-row' + disc_row + '').remove();
  document.getElementById("discount_active" + disc_row + '').value = 3;
}

  var discount_row = {{ $discount_row }};

function checkCountDiscounts() {
    //console.log('Check');
    var discount_row_count = document.getElementById("discount_row_count");
    discount_row_count.value = discount_row;
  }
  setInterval(checkCountDiscounts, 1000);

  function addDiscount() {
    html = '<tr id="discount-row' + discount_row + '">';
    html += '  <td class="text-left"><select name="product_discount' + discount_row + '[customer_group_id]" class="form-control">';
    @foreach ($customer_groups as $customer_group)
    html += '    <option value="{{ $customer_group->customer_group_id }}">{{ $customer_group->name }}</option>';
    @endforeach
    html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_discount' + discount_row + '[quantity]" value="" placeholder="Введите количество" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_discount' + discount_row + '[priority]" value="" placeholder="Введите порядок сортировки" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_discount' + discount_row + '[price]" value="" placeholder="Введите цену" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="date" name="product_discount' + discount_row + '[date_start]" value="" placeholder="Введите дату начала" data-date-format="DD.MM.YYYY" class="form-control" /></div></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="date" name="product_discount' + discount_row + '[date_end]" value="" placeholder="Введите Дату окончания" data-date-format="DD.MM.YYYY" class="form-control" /></div></td>';
    html += '  <td class="text-left"><button type="button" onclick="removeDiscounts(' + discount_row + ');" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    html += '<input type="hidden" id="discount_active' + discount_row + '" name="product_discount' + discount_row + '[active]" value="1">';
    /*html += '<input type="hidden" id="discount_id' + discount_row + '" name="product_discount' + discount_row + '[product_discount_id]" value="' + discount_row + '">';*/

    $('#discount tbody').append(html);

    discount_row++;
  }

  //--></script>
</div>


<div>
<input class="btn btn-primary" id="button_send_save" type="submit" value="Сохранить">
</div>

  <script type="text/javascript"><!--
  var image_row = {{ $image_row }};

  function checkCountImages() {
    //console.log('Check');
    var image_row_count = document.getElementById("image_row_count");
    image_row_count.value = image_row;
  }
  setInterval(checkCountImages, 1000);

  function addImage() {
    html = '<tr id="image-row' + image_row + '">';
    html += '<td class="text-left">';
    /*html += '<a href="" id="thumb-image' + image_row + '" data-toggle="image" class="img-thumbnail">';
    html += '<img src="Изображение" alt="" title="" data-placeholder="Изображение" />';
    html += '</a>';*/

    html += '<input type="file" class="form-control" name="product_image'+ image_row + '[image]" id="input-image' + image_row + '">';
   
    html += '</td>';
    html += '<td class="text-right"><input type="text" name="product_image' + image_row + '[sort_order]" value="" placeholder="Введите порядок сортировки" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="removeImages({{ $image_row }});" data-toggle="tooltip" title="Удалить" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

html += '<input type="hidden" id="image_active' + image_row + '" name="image_active' + image_row + '" value="1">';
html += '<input type="hidden" id="product_image_id' + image_row + '" name="product_image_id' + image_row + '" value="' + image_row + '">';

    $('#images tbody').append(html);

    image_row++;
  }

function removeImages(image_row) {
  var img_row = image_row;
  $('#image-row' + img_row + '').remove();
  document.getElementById("image_active" + img_row + '').value = 0;
}

  //--></script>

<script type="text/javascript"><!--

function removeAttributes(attribute_row) {
  var attr_row = attribute_row;
  $('#attribute-row' + attr_row + '').remove();
  document.getElementById("attribute_active" + attr_row + '').value = 3;
}

var attribute_row = {{$attribute_row}};


function checkCountAttributes() {
  //console.log('Check');
  var attribute_row_count = document.getElementById("attribute_row_count");
  attribute_row_count.value = attribute_row;
}
setInterval(checkCountAttributes, 1000);




  function addAttribute() {
    
    /*html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_attribute' + attribute_row + '[name]" value="" placeholder="Выберете атрибут из списка" class="form-control" /><input type="hidden" name="product_attribute' + attribute_row + '[attribute_id]" value="" /></td>';*/

    
    html = '<tr id="attribute-row' + attribute_row + '">';
    html += '<td class="text-left" style="width: 20%;">';
    html += '<select class="form-control" name="product_attribute' + attribute_row + '[attribute_id]">';
    html += '<option value="0">-- Не выбрано --</option>';
    @foreach ($attribute_descriptions as $attribute_description_select)
    html += '<option value="{{$attribute_description_select->attribute_id or ""}}"';
    @isset($attribute->attribute_id)
    @if ($attribute->attribute_id == $attribute_description_select->attribute_id)
    html += 'selected=""';
    @endif
    @if ($attribute->attribute_id == $attribute_description_select->attribute_id)
    html += 'hidden=""';
    @endif
    @endisset
    html +='>';
    html +='{!! $delimiter or "" !!}{{$attribute_description_select->name or ""}}';
    html +='</option>';  
    @endforeach
    html += '</select>';
    html += '</td>';
    html += '  <td class="text-left">';
    @foreach ($languages as $language)
    html += '<div class="input-group"><span class="input-group-addon">{{$language->name}}</span><textarea name="product_attribute' + attribute_row + '[product_attribute_text{{$language->id}}]" rows="5" placeholder="{{$language->name}}" class="form-control"></textarea></div>';
     @endforeach
    html += '  </td>';
    html += '  <td class="text-right"><button type="button" onclick="removeAttributes({{ $attribute_row }});" data-toggle="tooltip" title=" button_remove " class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
html += '<input type="hidden" id="attribute_active{{ $attribute_row }}" name="attribute_active{{ $attribute_row }}" value="1">';
html += '<input type="hidden" id="attribute_id{{ $attribute_row }}" name="attribute_id{{ $attribute_row }}" value="{{ $attribute_row }}">';
    $('#attribute tbody').append(html);

    //attributeautocomplete(attribute_row);

    attribute_row++;
    console.log(attribute_row);
  }
/*
  function attributeautocomplete(attribute_row) {
    $('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
      'source': function(request, response) {
        $.ajax({
          url: 'admin.attributes.partials.attributes',
          dataType: 'json',
          success: function(json) {
            response($.map(json, function(item) {
              return {
                category: item.attribute_group,
                label: item.name,
                value: item.attribute_id
              }
            }));
          }
        });
      },
      'select': function(item) {
        $('input[name=\'product_attribute[' + attribute_row + '][name]\']').val(item['label']);
        $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
      }
    });
  }

  $('#attribute tbody tr').each(function(index, element) {
    attributeautocomplete(index);
  });*/
  //--></script>


</div>

<!-- SCRIPT -->
