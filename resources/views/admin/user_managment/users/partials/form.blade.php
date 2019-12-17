@if ($errors->any())
 <div class="alert alert-danger">
 	<ul>
 		@foreach ($errors->all() as $error)
 		<li>{{$error}}</li>
 		@endforeach

 	</ul>
 </div>
@endif

<label for="">Имя, Отчество</label>
<input type="text" class="form-control" name="name" placeholder="Имя, Отчество" value="@if(old('name')){{old('name')}}@else{{$user->name or ""}}@endif" required>

<label for="">Фамилия</label>
<input type="text" class="form-control" name="surname" placeholder="Фамилия" value="@if(old('surname')){{old('surname')}}@else{{$user->surname or ""}}@endif" required>

<label for="">E-mail</label>
<input type="email" class="form-control" name="email" placeholder="E-mail" value="@if(old('email')){{old('email')}}@else{{$user->email or ""}}@endif" required>

<label for="">Пароль</label>
<!--{{$user->password or ""}}-->
<input type="password" class="form-control" name="password" placeholder="Пароль" value="" >

<label for="">Подтверждение пароля</label>
<input type="password" class="form-control" name="password_confirmation" placeholder="Подтверждение пароля" value="" >

<label for="">Телефон</label>
<input type="text" class="form-control" name="phone" placeholder="Телефон" value="{{$user->phone or ""}}" required>

<label for="">Страна</label>
<select class="form-control" name="country">
  <option value="0" >-- Не указано --</option>
  @include('admin.user_managment.users.partials.country', ['countries' => $countries])
</select>

<label for="">Регион</label>
<select class="form-control" name="region">
  <option value="0">-- Не указано --</option>
  @include('admin.user_managment.users.partials.region', ['regions' => $regions])
</select>

<label for="">Город</label>
<input type="text" class="form-control" name="city" placeholder="Город" value="{{$user->city or ""}}" required>

<label for="">Адрес</label>
<input type="text" class="form-control" name="address" placeholder="Адрес" value="{{$user->address or ""}}" required>

<label for="">Индекс</label>
<input type="text" class="form-control" name="index_address" placeholder="Индекс" value="{{$user->index_address or ""}}" required>

<label for="">Группа пользователя</label>
<select class="form-control" name="customer_group_id">
  <option value="0">-- Не указано --</option>
  @include('admin.user_managment.users.partials.customer_group', ['customer_groups' => $customer_groups])
</select>

<label for="">Статус пользователя</label>
<select class="form-control" name="user_tag_id">
  <option value="0">-- Не указано --</option>
  @include('admin.user_managment.users.partials.user_tag', ['user_tags' => $user_tags])
</select>

<label for="">Пол пользователя</label>
<select class="form-control" name="user_sex_id" id="user_sex_id">
  @if (isset($user->id))
  	<option value="">--Не выбрано--</option>
    <option value="1" @if ($user->user_sex_id == 1) selected="" @endif>Мужчина</option>
    <option value="2" @if ($user->user_sex_id == 2) selected="" @endif>Женщина</option>
  @else
   <option value="">--Не выбрано--</option>
   <option value="1">Мужчина</option>
   <option value="2">Женщина</option>
  @endif
</select>

<label for="">Язык пользователя</label>
<select class="form-control" name="language_id">
  <option value="0">-- Не указано --</option>
  @include('admin.user_managment.users.partials.language', ['langs' => $langs])
</select>
<hr />

<input class="btn btn-primary" type="submit" value="Сохранить">