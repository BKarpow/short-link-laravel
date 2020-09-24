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
                        <div style="
                            background-image: url({{$item->main_img}});
                            background-position: center;
                            background-repeat: repeat-x;
                            height: 13rem;
                            position:relative;
                            "></div>
                        <div class="title-post-card">
                            <a
                                href="{{route('post', ['id_alias' => $item->id.'-'.$item->alias.'.html'])}}">
                                {{$item->title}}
                            </a>
                        </div>
                        <!-- /.title-post-card -->

                        <div class="card-body">
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
