@extends('layouts.app')

@section('text-title') {{$data->post_title}} @endsection

@section('meta')
    <meta name="description" content="{{$data->short_text}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 p-2">
                <h2 class="display-3">{{$data->post_title}}</h2>
                <div class="meta-post-box">
                    <span>Автор: {{$data->user_name}}</span> ,
                    <span>Категорія: {{$data->title}}</span> ,
                    <span>Створено: {{$data->created_at}}</span> ,
                    <span>Переглядів: {{$data->previews}}</span>

                </div>
                <div class="my-1 d-flex justify-content-center">
                    <img src="{{$data->main_img}}" alt="no photo">
                </div>
                <!-- /.my-1 -->
                <div class="my-2">
                    {!! $data->text !!}
                </div>
                <!-- /.my-2 -->
            </div>
        </div>
        <!-- /.row -->
        <div class="rom mt-2 justify-content-center align-items-center">

        </div>
        <!-- /.rom mt-2 -->
    </div>
    <!-- /.container -->
@endsection
