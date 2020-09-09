@extends('layouts.app')

@section('text-title') Про нас @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="jumbotron">
                    <h1 class="display-4">Скорочення посилань</h1>
                    <p class="lead">
                        Цей сервіс дає змогу скорочувати посилання, та інструменти API
                    </p>
                    <p class="lead">
                        Для використання API звернітся за xymerone@gmail.com
                    </p>
                    <p class="lead">
                        Автор Богдан Карпов
                    </p>
                    <!-- /.lead -->
                    <hr class="my-4">
                    <a class="btn btn-primary btn-lg" href="tg://@BogdanKarpov" role="button">
                        <i class="fab fa-telegram-plane"></i>
                        Мій телеграм
                    </a>
                </div>
            </div>
            <!-- /.col-md-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
