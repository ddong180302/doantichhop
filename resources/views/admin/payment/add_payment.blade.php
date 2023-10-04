@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm phương thức thanh toán
                </header>
                @if (session('message'))
                    <script>
                        toastify().success('{{ session('message') }}');
                    </script>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/add-payment') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên phương thức thanh toán</label>
                                <input type="text" name="payment_method" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="payment_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" name="add_coupon" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
