<label for="">Назание страны</label>
<input type="text" class="form-control" name="country_name" placeholder="Название страны" value="{{$country->country_name or ""}}" required>

<label for="">Языковой пакет (Русский - 1)</label>
<input type="text" class="form-control" name="language_id" placeholder="Языковой пакет" value="{{$country->language_id or ""}}" required>

<!--<label for="">Языковой пакет</label>
<select class="form-control" name="language_id">
  <option value="0">-- без языкового пакета --</option>
 {{-- @include('admin.categories.partials.categories', ['categories' => $categories])  --}}
</select>-->

<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">