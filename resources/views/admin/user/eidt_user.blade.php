@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật người dùng
                </header>
                <div class="panel-body">
                    @foreach ($edit_product as $key => $edit_value)
                        <div class="position-center">
                            @if (session('message'))
                                <script>
                                    toastify().success('{{ session('message') }}');
                                </script>
                            @endif
                            <form role="form" action="{{ URL::to('/update-user/' . $edit_value->user_id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên người dùng</label>
                                    <input type="text" class="form-control" value="{{ $edit_value->user_name }}"
                                        name="product_name">
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật người dùng</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
