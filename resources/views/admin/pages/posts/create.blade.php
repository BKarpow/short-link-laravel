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

        function sendFile(file, el) {
            var  data = new FormData();
            data.append("file", file);
            var url = '{{ route('upload') }}';
            $.ajax({
                data: data,
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function(url2) {
                    el.summernote('insertImage', url2);
                }
            });
        }
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
                    <field-tags-component
                        uri-set="{{route('tags.ajax.new')}}"
                        uri-get="{{route('tags.ajax.all')}}"
                    ></field-tags-component>

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
