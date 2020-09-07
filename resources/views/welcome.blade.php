@extends('layouts.app')

@section('text-title') Головна @endsection

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
                                value="{{ session('short_link') }}"
                            >
                            <!-- /.form-control -->
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <button class="btn btn-success">Додати</button>
                        </div>
                    </form>
                    <div class="mt-3 px-1 py-2">
                        <h4 class="text-center">Ваші скорочення</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="d-block">
                                        Скорочення
                                    </span>
                                    <span class="d-block">
                                        Переходи
                                    </span>
                                    <span class="d-block">
                                        Відстежити (Лог переходів)
                                    </span>
                                </div>
                            </li>
                            @foreach($my_shorts as $item)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="d-block">
                                        <a href="{{ asset('/' . $item->short_id) }}">
                                            {{  substr($item->url, 0, 20)  }}...
                                        </a>

                                    </span>
                                        <span class="d-block">
                                        {{ $item->linked }}
                                    </span>
                                        <span class="d-block">
                                        <a href="/log/{{$item->short_id}}">
                                            Відстежити
                                        </a>
                                    </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="d-flex py-3 mt-1 justify-content-center align-items-center">
                            {{$my_shorts->links()}}
                        </div>
                    </div>
                    <!-- /.px-1 -->
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
