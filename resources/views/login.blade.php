@extends('layouts.app')

@section('html_header')
    <style type="text/css">
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
@endsection

@section('main_content')
    <div class="container">

        <form class="form-signin" method="POST" action="{{route('do-login')}}">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Ошибка!</strong> Вход в систему с указанными данными невозможен.
                </div>
            @endif

            <h2 class="form-signin-heading">Авторизация</h2>

            <label for="user_login" class="sr-only">Логин</label>
            <input type="text" name="name" value="{{ old('name') }}" id="user_login" class="form-control" placeholder="Логин" required autofocus>

            <label for="user_password" class="sr-only">Пароль</label>
            <input type="password" name="password" value="{{old('password   ')}}" id="user_password" class="form-control" placeholder="Пароль" required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="remember-me" checked> Запомнить меня
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

            @csrf
        </form>

    </div>
@endsection