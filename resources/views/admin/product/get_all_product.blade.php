@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Tìm kiếm">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="text-alert">', $message, '</div>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Hình Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_all_product as $key => $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td><img src="public/uploads/product/{{ $product->product_image }}" height="100"
                                        width="150"></td>
                                <td>
                                    <span class="text-ellipsis">
                                        <?php
                                                    if($product->product_status==1){
                                                ?>
                                        <a href="{{ URL::to('/unactive-product/' . $product->product_id) }}">
                                            <span> Hiển thị</span></a>
                                        <?php
                                                    }else{
                                                        ?>
                                        <a href="{{ URL::to('/active-product/' . $product->product_id) }}">
                                            <span>Ẩn</span></a>
                                        <?php
                                                    }
                                            ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/edit-product/' . $product->product_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                        href="{{ URL::to('/delete-product/' . $product->product_id) }}"
                                        class="active styling-delete" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="clearfix">
                    {{ $get_all_product->links() }}
                </div>
            </footer>
        </div>
    </div>
@endsection
