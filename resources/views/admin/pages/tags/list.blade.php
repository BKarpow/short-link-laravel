@extends('admin.layouts.app')

@section('text-title') Список міток @endsection

@section('scripts')
    <script>
        window.onload = function(){

        }
    </script>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3>Мітки</h3>
                <div class="d-flex justify-content-between py-2">
                    <a href="" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle"></i>
                        Додати мітку
                    </a>
                    <!-- /.btn -->
                </div>
                <!-- /.d-flex -->
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Назва</th>
                            <th>Контроль</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->name }} </td>
                                <td>
                                        <a href="{{route('update-page', ['alias'=>'ggg'])}}">
                                            <i class="fas fa-edit"></i>
                                        </a> |
                                    <del-link
                                        delete-link="{{ route('tags.delete', ['tag_id' => $item->id]) }}"
                                        message-delete-confirm="Видалити {{$item->name}} ?"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </del-link>
                                </td> -c
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
