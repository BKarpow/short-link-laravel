@extends('admin.layouts.app')

@section('text-title') Створення нового токенц @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (!empty( $token ))
                    <h3>Ваш новий токен: {{ $token }} </h3>
                @endif

            </div>
            <!-- /.col-md-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
