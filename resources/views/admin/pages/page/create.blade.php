@extends('admin.layouts.app')

@if (!empty($data))
@section('text-title') Оновлення сторінки {{$data->title}} @endsection
@else
@section('text-title') Створення сторінки @endsection
@endif

@section('styles')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.editors').summernote({
                placeholder: 'Опис',
                tabsize: 2,
                height: 350,
                callbacks: {
                    onImageUpload: function (files) {
                        const el = $(this);
                        uploadFile(files[0], el);
                    }
                }
            });
        });

        const uploadFile = (file, el) => {
            const fData = new FormData()
            fData.append('file', file)
            axios.post('{{route('upload')}}', fData)
                .then(response => {
                    const path = response.data.path
                    console.log('File upload', path)
                    el.summernote('insertImage', path);
                })
                .catch(err => {
                    console.error(err)
                })
        }
    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form
                    @if (!empty($data))
                        action="{{route('update-page-action')}}"
                    @else
                        action="{{route('create-page-action')}}"
                    @endif

                    method="POST"
                >
                    @csrf
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        @if (!empty($data))
                            <input type="text"
                                   name="title"
                                   class=" form-control"
                                   placeholder="Заголовок"
                                   value="{{$data->title}}"
                            >
                            <!-- /.form-control -->
                        @else
                            <input type="text" name="title" class="form-control" placeholder="Заголовок">
                            <!-- /.form-control -->
                        @endif

                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="alias">URL (адреса сторінки)</label>
                        @if (!empty($data))
                            <h4>url: /page/{{$data->alias}}</h4>
                            <input type="hidden" name="alias" value="{{$data->alias}}">
                        @else
                            <field-alias-component></field-alias-component>
                        @endif

                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group">
                        <label for="page">Сторінка</label>
                        <textarea name="page" id="page" cols="30" rows="10" class="editors">@if (!empty($data)) {{$data->page}} @endif</textarea>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group d-flex justify-content-center">
                        @if (!empty($data))
                            <button class="btn btn-success btn-lg">Оновити сторінку</button>
                            <!-- /.btn -->
                        @else
                            <button class="btn btn-success btn-lg">Додати сторінку</button>
                            <!-- /.btn -->
                        @endif

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
