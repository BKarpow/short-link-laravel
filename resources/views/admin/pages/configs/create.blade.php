@extends('admin.layouts.app')

@section('text-title') Додати конфігурацію @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2 class="text-center">Створити конфігурацію</h2>
            <form action="{{route('configs.create.action')}}" method="POST">
                @csrf
                <configs-namespace url-all="{{route('configs.ajax.namespaces')}}"></configs-namespace>
                <div class="form-group">
                    <label for="key">Ключ</label>
                    <input
                        type="text"
                        name="key"
                        id="key"
                        class="form-control"
                        placeholder="Ключ"
                    >
                    <!-- /.form-control -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="value">Значення</label>
                    <input
                        type="text"
                        name="value"
                        id="value"
                        class="form-control"
                        placeholder="Значення"
                    >
                    <!-- /.form-control -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="">Назва</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        placeholder="Назва конфігураціїї"
                    >
                    <!-- /.form-control -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="description">Опис конфігурації</label>
                    <textarea
                        name="description"
                        id="description"
                        cols="30"
                        rows="10"
                        class="form-control"
                    ></textarea>
                    <!-- /#.form-control -->
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <button class="btn btn-primary">Створити</button>
                    <!-- /.btn -->
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.col-md-10 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

@endsection
