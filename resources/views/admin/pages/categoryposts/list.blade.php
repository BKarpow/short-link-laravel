@extends('admin.layouts.app')

@section('text-title') Список категорій @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h3>Список категорій</h3>
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Зображення</th>
                            <th>Назва</th>
                            <th>Контроль</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td> {{ $item->id }} </td>
                            <td>
                                <div class="px-lg-1" style="width: 80px;">
                                    <img
                                        src="{{ $item->icon_path }}"
                                        class="img-fluid"
                                        alt="Неммає зображення">
                                </div>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="{{route('update-category', ['id'=>$item->id])}}">
                                    Редагувати
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
