@extends('layouts.app')

@section('text-title') Відстеження переходів @endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center">Лог переходів по вашим скороченням.</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>IP</th>
                            <th>User-Agent</th>
                            <th>Перехід</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->ip }}</td>
                                <td>{{ $item->user_agent }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.table-response -->
                <div class="py-3 d-flex justify-content-center align-items-center">
                    {{ $data->links() }}
                </div>
            </div>
            <!-- /.col-lg-8 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
