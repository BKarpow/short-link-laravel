@extends('admin.layouts.app')

@section('text-title') Список конфігурацій @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3>Категорії конфігурацій</h3>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="{{route('configs.create')}}" class="btn btn-success">
                        Створити конфігурацію
                    </a>
                </div>
                <!-- /.my-2 -->
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Namespace (Категорія)</th>
                            <th>Контроль</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>

                                <td>
                                    <a href="{{route('configs.namespace', ['namespace' =>$item->namespace])}}">
                                    {{$item->namespace}} ({{$item->count}})
                                    </a>

                                </td>

                                <td>
                                    <a href="">
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a href="">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.table-response -->
                <div class="d-flex justify-content-center align-items-center my-2" id="paginate">
                    {{ $data->links() }}
                </div>
                <!-- /#paginate.d-flex -->
            </div>
            <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
