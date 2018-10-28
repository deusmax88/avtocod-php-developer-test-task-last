@extends('layouts.app')

@section('html_header')
    <style type="text/css">
        .user-avatar {
            margin-top: 5px;
            width: 100%;
        }

        .wall-message {
            border: solid #eee;
            border-width: 0 0 1px 0;
            margin-bottom: 1em;
        }

        .wall-message:last-child {
            border-width: 0;
        }
    </style>
@endsection

@section('main_content')
    <!-- Begin page content -->
    <div class="container">
        <div class="page-header">
            <h1>Сообщения от всех пользователей</h1>
        </div>

        @auth
        <form method="post" class="form-horizontal">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Ошибка!</strong> Сообщение не может быть пустым.
            </div>
            @endif

            <div class="controls">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="message_text">Текст сообщения:</label>
                        <textarea id="message_text" name="content" class="form-control"
                                  placeholder="Ваше сообщение" rows="4"
                                  required="required"></textarea>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <input type="submit" class="btn btn-success btn-send" value="Отправить сообщение" />
                </div>
            </div>
            @csrf
        </form>
        @endauth

        @foreach($messages as $message)
            <div class="row wall-message">
                <div class="col-md-1 col-xs-2">
                    <img src="http://lorempixel.com/200/200/people/" alt="" class="img-circle user-avatar" />
                </div>
                <div class="col-md-10 col-xs-9">
                    <p>
                        <strong>{{ $message->user->name }}</strong>
                    </p>
                    <blockquote>
                        {{ $message->content }}
                    </blockquote>
                </div>

                <div class="col-md-1 col-xs-1">
                    @if(Auth::user() && Auth::user()->is($message->user))
                        <a href="{{route('delete-message',['messageId' => $message->id])}}"
                            class="btn btn-warning">
                            Удалить
                        </a>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
@endsection