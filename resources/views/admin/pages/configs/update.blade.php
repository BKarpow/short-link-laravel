@extends('admin.layouts.app')

@section('text-title') {{$namespace}} - конфігурація @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-center">Налаштування {{ $namespace }}</h2>
            <!-- /.text-center -->
        </div>
        <!-- /.row -->
        <form action="{{route('configs.action')}}" method="POST">
            @csrf
            <input type="hidden" name="namespace" value="{{ $namespace }}">
        <div class="row my-2">

                @foreach($data as $item)
                    <div class="col-md-4">
                        <div class="form-group">
                            <h3>{{$item->name}} ({{$item->key}})</h3>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <input
                                type="text"
                                name="{{$item->key}}"
                                value="{{$item->value}}"
                                class="form-control"
                            >
                            <!-- /.form-control -->
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-4 -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <p>{{$item->description}}</p>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-4 -->
                @endforeach

        </div>
        <!-- /.row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4">
                    <div class="form-group">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Зберегти
                        </button>
                        <!-- /.btn -->
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-md-4 -->
            </div>
        </form>
    </div>
    <!-- /.container -->
@endsection
