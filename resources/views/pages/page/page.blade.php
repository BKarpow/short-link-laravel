@extends('layouts.app')

@section('text-title') {{$data->title}} @endsection

@section('meta')
    <meta name="description" content="{{substr( strip_tags( $data->page), 0, 200)}}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 p-2">
                <h2 class="display-3">{{$data->title}}</h2>
                <div class="meta-post-box">
                    <span>Створено: {{$data->created_at}}</span> ,
                    <span>Переглядів: {{$data->previews}}</span>

                </div>

                <div class="my-2">
                    {!! $data->page !!}
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
