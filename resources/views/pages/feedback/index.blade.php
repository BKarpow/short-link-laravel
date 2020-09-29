@extends('layouts.app')

@section('text-title') Зворотній зв'язок @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center">Форма зворотнього зв'язку</h3>
                <!-- /.text-center -->
                <form action="{{route('feedback.action')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Ім'я</label>
                        <input type="text" name="name" class="form-control" placeholder="Вкажіть ваше імя">
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="email"><span style="color:red;">*</span>Email</label>
                        <input type="email" name="email" class="form-control">
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" name="title" class="form-control">
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="feedback">Ваш відгук</label>
                        <textarea name="feedback" id="" cols="30" rows="10" class="form-control"></textarea>
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <button class="btn btn-success btn-lg">Відправити</button>
                        <!-- /.btn -->
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
