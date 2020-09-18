@extends('admin.layouts.app')

@section('text-title') Додати медіа @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{route('media-add-action')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Назва</label>
                        <input type="text" name="title" class="form-control">
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->

                    <upload-component
                        route-delete="/admin/delete/image"
                        route-upload="/admin/upload/image"
                        name-field-file="file"
                    ></upload-component>

                    <div class="form-group">
                        <label for="description">Опис файлу</label>
                        <textarea
                            name="description"
                            cols="30"
                            rows="10"
                            placeholder="Опис файлу"
                            class="form-control"></textarea>
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-success btn-lg">Додати</button>
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
