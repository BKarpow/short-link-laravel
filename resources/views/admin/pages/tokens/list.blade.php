@extends('admin.layouts.app')

@section('text-title') Список моїх токенів API @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h4>Сптсок моїх токенів</h4>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Токен</th>
                            <th>Задіяний</th>
                            <th>Редагувати</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->token }}</td>
                                <td>{{ $item->request_count }}</td>
                                <td>
                                    <a href="/admin/token/delete/{{ $item->token }}">Видалити</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex py-3 justify-content-center align-items-center">
                    {{ $data->links() }}
                </div>
            </div>
            <!-- /.col-lg-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
