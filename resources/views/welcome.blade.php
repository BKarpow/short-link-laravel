@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if (!auth()->check())
                    <h3 align="center">Ви не авторизовані</h3>
                @else
                    <form action="{{ route('add-short') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="" ></label>
                            <input
                                type="text"
                                id="url"
                                name="url"
                                placeholder="Вставте посилання для скорочення"
                                class="form-control"
                            >
                            <!-- /.form-control -->
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <button class="btn btn-success">Додати</button>
                        </div>
                    </form>
                @endif
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6">
                <p>Додайте посилання для скорочення</p>
                <p> {{ session('short_link') }} </p>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->


@endsection
