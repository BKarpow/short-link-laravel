@extends('admin.layouts.app')

@section('text-title') Додати категорію @endsection

@section('content')
    <div id="app" class="container py-1">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3>Створення нової категорії</h3>
                <form action="{{ route('create-category-action') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Назва категорії</label>
                        <input
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
                        <upload-component></upload-component>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group">
                        <label for="parent">Батківська категорія</label>
                        <select name="parent" id="parent" class="form-control">
                            <option disabled selected>Оберіть категорію</option>
                            <option value="0" selected="">Без батьків(Головна)</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                            @endforeach
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="description">Опис категорії</label>
                        <textarea
                            name="description"
                            id="description"
                            cols="30"
                            rows="10"
                            placeholder="Опишіть категорію"
                            class="form-control"></textarea>
                        <!-- /#.form-control --></div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg">Додати</button>
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
