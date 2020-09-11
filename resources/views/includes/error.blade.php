@if ($errors->any())
    <div class="container my-2" id="error_box">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="alert alert-danger">
                    <strong>
                        <h3><i class="fas fa-bug"></i> Error list!</h3>
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </strong>
                </div>
            </div>
            <!-- /.col-md-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#error_box.container -->
@endif
