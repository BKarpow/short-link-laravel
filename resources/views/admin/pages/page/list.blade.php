@extends('admin.layouts.app')

@section('text-title') Список cторінок @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3>Список сторінк</h3>
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Url</th>
                            <th>Назва</th>
                            <th>Контроль</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td>
                                    <a href="{{route('page', ['alias'=>$item->alias])}}">
                                        {{route('page', ['alias'=>$item->alias])}}
                                    </a>
                                </td>

                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{route('update-category', ['id'=>$item->id])}}">
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a href="{{ route('delete-category', ['id' => $item->id]) }}">
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
