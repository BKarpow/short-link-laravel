@extends('admin.layouts.app')

@section('text-title') Головна @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 py-3">
                <h4>Всі скорочення</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ім'я користувача</th>
                            <th>URL</th>
                            <th>Short ID</th>
                            <th>Переходи</th>
                            <th>Останній перехід</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->short_id }}</td>
                                <td>{{ $item->linked }}</td>
                                <td>{{ $item->updated_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-2 d-flex justify-content-center align-items-center">

                    {{ $data->links() }}

                </div>
                <!-- /.my-2 d-flex -->
            </div>
            <!-- /.col-md-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
