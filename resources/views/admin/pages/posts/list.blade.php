@extends('admin.layouts.app')

@section('text-title') Список cтатей @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3>Статті</h3>
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Створено</th>
                            <th>Категорія</th>
                            <th>Назва</th>
                            <th>Контроль</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td> {{ $item->post_id }} </td>
                                <td> {{ $item->created_at }} </td>
                                <td> {{ $item->title }} </td>


                                <td>{{ $item->post_title }}</td>
                                <td>

                                        @if ($item->public == '1')
                                        <a href="{{route('trigger-public-post',['id'=>$item->post_id])}}" title="Вимкнути публікацію">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @else
                                            <a href="{{route('trigger-public-post',['id'=>$item->post_id])}}" title="Увімкнути публікацію">
                                                <i class="fas fa-eye-slash"></i>
                                            </a>
                                        @endif
                                    </a> |
                                    <a href="{{route('update-page', ['alias'=>'ggg'])}}">
                                        <i class="fas fa-edit"></i>
                                    </a> |
                                    <a href="{{ route('delete-post', ['id' => $item->post_id]) }}">
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
