@extends('layouts.app')

@section('text-title') Статті @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4 class="text-center">Статті</h4>
                <hr>
                @foreach($data as $item)
                    <div class="card mb-3">
                        <img src="{{$item->main_img}}" class="card-img-top img-fluid w-25" alt="no image">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a
                                    href="{{route('post', ['id_alias' => $item->id.'-'.$item->alias.'.html'])}}">
                                    {{$item->title}}
                                </a>

                            </h5>
                            <p class="card-text">{!! $item->short_text !!}</p>
                            <p class="card-text">
                                <small class="text-muted">Оновлено {{$item->updated_at}}</small>,
                                <small class="text-muted">Перегляди {{$item->previews}}</small>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.col-nd-10 -->
        </div>
        <!-- /.row -->
        <div class="rom mt-2 justify-content-center align-items-center">
            {{ $data->links() }}
        </div>
        <!-- /.rom mt-2 -->
    </div>
    <!-- /.container -->
@endsection
