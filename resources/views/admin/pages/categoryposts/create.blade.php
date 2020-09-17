@extends('admin.layouts.app')

@if (!empty($data))
    @section('text-title') Редагувати категорію {{ $data->title }} @endsection
@else
    @section('text-title') Додати категорію @endsection
@endif



@section('content')
    <div id="app" class="container py-1">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3>Створення нової категорії</h3>
                <form
                    @if (!empty($data))
                        action="{{ route('update-category-action', ['id'=>$id]) }}"
                    @else
                        action="{{ route('create-category-action') }}"
                    @endif
                    method="POST"
                >
                    @csrf
                    <div class="form-group">
                        <label for="title">Назва категорії</label>
                        <input
                            @if (!empty($data)) value="{{$data->title}}" @endif
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            placeholder="Вкажіть назву нової категорії"
                        >
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <upload-component
                            route-delete="/admin/delete/image"
                            route-upload="/admin/upload/image"
                            name-field-file="icon_path"
                            @if (!empty($data))
                                default-src="{{$data->icon_path}}"
                            @endif
                        ></upload-component>
                    </div>
                    <!-- /.form-group -->

                    @if (empty($data))
                    <div class="form-group">
                        <label for="parent">Батківська категорія</label>
                        <select name="parent" id="parent" class="form-control">
                            <option disabled selected>Оберіть категорію</option>
                            <option value="0" >Без батьків(Головна)</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                            @endforeach
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    @else
                        <input type="hidden" name="parent" value="{{$data->parent_category}}">
                    @endif
                    <div class="form-group">
                        <label for="description">Опис категорії</label>
                        <textarea
                            name="description"
                            id="description"
                            cols="30"
                            rows="10"
                            placeholder="Опишіть категорію"
                            class="form-control">@if (!empty($data)){{$data->description}}@endif</textarea>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">
                            @if (!empty($data))
                                Оновити
                            @else
                                Додати
                            @endif
                        </button>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.col-md-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection

@section('scripts')

@endsection
