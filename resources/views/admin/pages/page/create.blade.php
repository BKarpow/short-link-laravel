@extends('admin.layouts.app')

@section('text-title') Створення сторінки @endsection

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
                <form action="{{route('create-page-action')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" class="form-control" placeholder="Заголовок">
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="alias">URL (адреса сторінки)</label>

                            <field-alias-component></field-alias-component>
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group">
                        <label for="page">Сторінка</label>
                        <textarea name="page" id="page" cols="30" rows="10" class="editors"></textarea>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-success btn-lg">Додати сторінку</button>
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
