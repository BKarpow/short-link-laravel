@extends('layouts.app')

@section('text-title') Головна @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-10 my-2">
                <h1 class="text-center">Скоротити посилання</h1>
                @if (!auth()->check())
                    <h3 align="center">Ви не авторизовані</h3>
                @else
                    <short-field-component></short-field-component>
                @endif
            </div>
            <!-- /.col-md-10 -->

        </div>
        <!-- /.row -->
        <div class="row mt-3">
            <div class="mt-3 px-1 py-2">
                <h4 class="text-center">Ваші скорочення</h4>
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Url скорочення</th>
                            <th>Скорочений Url</th>
                            <th>Переходи</th>
                            <th>Додатково</th>
                            <th>Останній перехід</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($my_shorts as $item)
                            <tr>
                                <td>{{ $item->url }}</td>
                                <td>{{url('/') . $item->short_id}}</td>
                                <td>{{ $item->linked  }}</td>
                                <td>
                                    <a
                                        rel="nofollow"
                                        title="Відстежити переходи"
                                        href="/log/{{$item->short_id}}">
                                        <i class="fas  fa-eye"></i>
                                    </a>
                                </td>
                                <td> {{ $item->updated_at }} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.table-response -->

                <div class="d-flex py-3 mt-1 justify-content-center align-items-center">
                    {{$my_shorts->links()}}
                </div>
            </div>
            <!-- /.px-1 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->



@endsection
