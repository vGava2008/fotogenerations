<ul class="nav navbar-nav navbar-right" name="locale" onchange="if(this.options[this.selectedIndex].value!=''){window.location=this.options[this.selectedIndex].value}else{this.options[selectedIndex=0];}">
        <li class="dropdown">
        	
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ trans('auth.lang_selection') }} <span class="caret"></span>
                </a>


                <ul class="dropdown-menu" role="menu">
                	@foreach($langs as $lang)
                    <li>
                    	@isset($lang->id)
                        <a href="/lang/{{$lang->locale or ""}}" onclick="">{{$lang->name  or ""}}</a>
                        @endisset
                    </li>
                    @endforeach
                </ul>
            </li>
    </ul>