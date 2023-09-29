@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thông số sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @if (session('message'))
                            <script>
                                toastify().success('{{ session('message') }}');
                            </script>
                        @endif
                        <form role="form" action="{{ URL::to('/save-specifications-product') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <select name="product_id" class="form-control input-sm m-bot15">
                                    @foreach ($product as $key => $pro)
                                        <option value="{{ $pro->product_id }}">{{ $pro->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bộ vi xử lý</label>
                                <input type="text" class="form-control" name="cpu" placeholder="C P U">
                            </div>
                            <div class="form-group">
                                <label>Bộ nhớ</label>
                                <input type="text" class="form-control" name="ram" placeholder="Bộ nhớ">
                            </div>
                            <div class="form-group">
                                <label>Ổ cứng</label>
                                <input type="text" class="form-control" name="storage" placeholder="Ổ cứng">
                            </div>
                            <div class="form-group">
                                <label>Card đồ họa</label>
                                <input type="text" class="form-control" name="graphics_card" placeholder="Card đồ họa">
                            </div>
                            <div class="form-group">
                                <label>Kích thước màn hình</label>
                                <input type="text" class="form-control" name="screen_size"
                                    placeholder="Kích thước màn hình">
                            </div>
                            <div class="form-group">
                                <label>Độ phân giải màn hình</label>
                                <input type="text" class="form-control" name="screen_resolution"
                                    placeholder="Độ phân giải màn hình">
                            </div>
                            <div class="form-group">
                                <label>Hệ điều hành</label>
                                <input style="text" class="form-control" name="operating_system"
                                    placeholder="Hệ điều hành" />
                            </div>
                            <div class="form-group">
                                <label>Trọng lượng</label>
                                <input style="text" class="form-control" name="weight" placeholder="Trọng lượng" />
                            </div>
                            <div class="form-group">
                                <label>Pin</label>
                                <input style="text" class="form-control" name="battery" placeholder="Pin" />
                            </div>
                            <div class="form-group">
                                <label>Cổng kết nối</label>
                                <input style="text" class="form-control" name="connectivity_ports"
                                    placeholder="Cổng kết nối" />
                            </div>
                            <div class="form-group">
                                <label>Màu sắc</label>
                                <input style="text" class="form-control" name="color" placeholder="Màu sắc" />
                            </div>
                            <div class="form-group">
                                <label>Bàn phím</label>
                                <input style="text" class="form-control" name="keyboard" placeholder="Bàn phím" />
                            </div>

                            <div class="form-group">
                                <label>Webcam</label>
                                <input style="text" class="form-control" name="webcam" placeholder="Webcam" />
                            </div>
                            <div class="form-group">
                                <label>Âm thanh</label>
                                <input style="text" class="form-control" name="audio" placeholder="Âm thanh" />
                            </div>
                            <div class="form-group">
                                <label>Kích thước</label>
                                <input style="text" class="form-control" name="size" placeholder="Kích thước" />
                            </div>
                            <button type="submit" name="add_specifications_product" class="btn btn-info">Thêm thông số kỹ
                                thuật</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
