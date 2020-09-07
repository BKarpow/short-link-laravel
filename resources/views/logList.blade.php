@extends('layouts.app')

@section('text-title') Відстеження переходів @endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="text-center">Лог переходів по вашим скороченням.</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <ul class="list-group">
                    @foreach($data as $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <span class="d-block"> {{ $item->ip }} </span>
                                <span class="d-block"> {{ $item->user_agent }} </span>
                            </div>
                        </li>
                    @endforeach
                </ul>
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
