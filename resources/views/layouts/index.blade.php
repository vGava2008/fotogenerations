@include('layouts.head')

<body>

    <div class="wrapper">

@include('layouts.header')
@section('title',"VIAR") 
@section('css')
{{-- Html::style(asset('css/home.css')) --}}
@endsection

@include('layouts.general')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ trans('auth.your_login') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</div>

    @include('layouts.foother')