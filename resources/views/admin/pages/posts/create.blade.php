@extends('admin.layouts.app')

@section('text-title') Створення статті @endsection

@section('styles')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.editors').summernote({
                placeholder: 'Hello Bootstrap 4',
                tabsize: 2,
                height: 450
            });
        });
    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="{{route('create-post-action')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" class="form-control" placeholder="Заголовок">
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <image-selector-component></image-selector-component>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group">
                        <label for="category_id">Оберіть категорію</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option selected="">Обрати категорію</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="short_text">Короткий опис</label>
                        <textarea name="short_text" id="short_text" cols="30" rows="10" class="editors form-control"></textarea>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="text">Стаття</label>
                        <textarea name="text" id="text" cols="30" rows="10" class="editors"></textarea>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-success btn-lg">Додати статтю</button>
                        <!-- /.btn -->
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.col_md_10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

@endsection
