{{-- Main header --}}
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Avtocod | Стена сообщений</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/">Главная</a></li>
            @guest
                <li><a href="{{route('login')}}">Авторизация</a></li>
                <li><a href="{{route('register')}}">Регистрация</a></li>
            @endguest
        </ul>
        @auth
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text"><span class="glyphicon glyphicon-user"></span>{{Auth::user()->name}}</li>
                <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
            </ul>
        @endauth
    </div>
</nav>
