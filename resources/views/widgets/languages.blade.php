<!-- <select class="form-control" onchange="/*if(this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}else{this.options[selectedIndex=0];}*/"> -->

	<select class="form-control" name="locale" onchange="if(this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}else{this.options[selectedIndex=0];}">
<!--<option value="" >{{-- trans('auth.lang_choose') --}}</option>-->

	@foreach($langs as $lang)
		<option value="/lang/{{$lang->locale or ""}}" 
			@isset($lang->id)
				@if ($lang->locale == config('app.locale'))
					selected="selected"
				@endif
			@endisset
		>
		{{$lang->name  or ""}}
	</option>
	@endforeach


	{{-- {echo 'selected';} ?> value="/lang/{{ $lang->locale }}">{{ $lang->name }} --}}