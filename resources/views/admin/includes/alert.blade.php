@if (!empty(session('status')))
<div class="container my-2">
    <div class="row justify-content-center align-items-center">
        <div class="alert alert-success">
            <strong>{{ session('status') }}</strong>
        </div>
    </div>
</div>
@else
    @if ($errors->any())
        <div class="container my-2">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9">
                    <div class="alert alert-danger">
                        <h4>Є омилки(ф)</h4>
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /.col-lg-9 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container my-2 -->
    @endif


@endif
