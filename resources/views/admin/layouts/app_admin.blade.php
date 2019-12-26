<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'VIAR - Admin') }}</title>
<!--<script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script>-->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<script src="{{ asset('/js/ckeditor/ckeditor.js') }}"
type="text/javascript" charset="utf-8" ></script>
<!--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">-->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    <!--<link href="{{ asset('js/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/datetimepicker/bootstrap-datetimepicker.min.js') }}" rel="preload">
    <script type="text/javascript" src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>-->
   <!--<link href="{{ asset('css/admin/bootstrap.css') }}" type="text/css" rel="stylesheet" media="screen">-->

    <!--<script type="text/javascript" src="{{ asset('js/admin/jquery/jquery-2.1.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/jquery/datetimepicker/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/jquery/datetimepicker/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/jquery/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <link href="{{ asset('js/admin/jquery/datetimepicker/bootstrap-datetimepicker.min.css') }}" type="text/css" rel="stylesheet" media="screen">-->

    <!--<link href="{{ asset('css/admin/stylesheet.css') }}" type="text/css" rel="stylesheet" media="screen">-->

    <!--<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />-->
    <!--<script type="text/javascript" src="{{ asset('js/admin/common.js') }}"></script>-->
    <!--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>-->

   




    

    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        VIAR - Admin
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav dropdown">
                        <li><a href="{{route('admin.index')}}">Панель состояния</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Управление пользователями<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('admin.user_managment.user.index')}}">Пользователи</a></li>
                                <li><a href="{{route('admin.country.index')}}">Страны пользователей</a></li>
                                <li><a href="{{route('admin.region.index')}}">Регионы пользователей</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Блог<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('admin.blog.index')}}">Новости</a></li>
                                <li><a href="{{route('admin.idea.index')}}">Идеи</a></li>
                                <li><a href="{{route('admin.question.index')}}">Воросы и ответы</a></li>
                                <li><a href="{{route('admin.category.index')}}">Категории</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Управление товарами<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('admin.product.index')}}">Товары</a></li>
                                <li><a href="{{route('admin.category.index')}}">Категории</a></li>
                                <li><a href="{{route('admin.manufacturer.index')}}">Производители</a></li>
                                <li><a href="{{route('admin.attribute.index')}}">Атрибуты товара</a></li>
                                <li><a href="{{route('admin.attribute_group.index')}}">Группы атрибутов</a></li>
                                <li><a href="{{route('admin.option.index')}}">Опции</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
<!-- Footer -->
    <footer class="page-footer font-small blue pt-4">
      <!-- Footer Links -->
      <div class="container-fluid text-center text-md-left">
        <!-- Grid row -->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-6 mt-md-0 mt-3">
            <!-- Content -->
            <h5 class="text-uppercase">Footer Content</h5>
            <p>Здесь вы можете использовать строки и столбцы для организации содержимого нижнего колонтитула.</p>
          </div>
          <!-- Grid column -->
          <hr class="clearfix w-100 d-md-none pb-3">
          <!-- Grid column -->
          <div class="col-md-3 mb-md-0 mb-3">
            <!-- Links -->
            <h5 class="text-uppercase">Каталог</h5>
            <ul class="list-unstyled">
              <li>
                <a href="{{route('admin.product.index')}}">Товары</a>
              </li>
              <li>
                <a href="{{route('admin.category.index')}}">Категории</a>
              </li>
              <li>
                <a href="{{route('admin.manufacturer.index')}}">Производители</a>
              </li>
              <li>
                <a href="{{route('admin.attribute.index')}}">Атрибуты товара</a>
              </li>
              <li>
                <a href="{{route('admin.attribute_group.index')}}">Группы атрибутов</a>
              </li>
            </ul>
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-3 mb-md-0 mb-3">
            <!-- Links -->
            <h5 class="text-uppercase">Клиенты / Пользователи</h5>
            <ul class="list-unstyled">
              <li>
                <a href="{{route('admin.user_managment.user.index')}}">Пользователи</a>
              </li>
              <li>
                <a href="{{route('admin.country.index')}}">Страны</a>
              </li>
              <li>
                <a href="{{route('admin.region.index')}}">Регионы</a>
              </li>
            </ul>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
      <!-- Footer Links -->
      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© <?php echo date ( 'Y' ) ; ?> Copyright:
        <a target="_blank" href="https://plemyastudio.ru/"> PlemyArt</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
