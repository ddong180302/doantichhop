@extends('admin_layout')
@section('admin_content')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê sản phẩm
            </div>
            <div class="row w3-res-tb" style="margin-bottom: 30px">
                <div class="col-sm-7 m-b-xs">
                    <form action="">
                        @csrf
                        <select name="filter_product" id="filter-product"
                            style="padding: 10px; border: 1px solid #333; border-radius: 5px">
                            <option>--Lọc Theo--</option>
                            <option value="{{ URL::to('/filter-product') }}?sort_by=moinhat">Mới Nhất</option>
                            <option value="{{ URL::to('/filter-product') }}?sort_by=tuA_Z">Từ A-Z</option>
                            <option value="{{ URL::to('/filter-product') }}?sort_by=tuZ_A">Từ Z-A</option>
                            <option value="{{ URL::to('/filter-product') }}?sort_by=tangdan">Giá từ Thấp Đến Cao</option>
                            <option value="{{ URL::to('/filter-product') }}?sort_by=giamdan">Giá từ Cao Đến Thấp</option>
                            <option value="{{ URL::to('/filter-product') }}?sort_by=banchay">Bán Chạy Nhất</option>
                        </select>
                    </form>
                </div>
                <div class="col-sm-5">
                    <form action="{{ URL::to('/search-product') }}" method="POST">
                        {{ csrf_field() }}
                        <div style="width: 100%; display: flex; flex-direction: row">
                            <div style="width: 80%">
                                <input type="text" name="key_product" class="input-sm form-control"
                                    placeholder="Tìm kiếm theo tên">
                            </div>
                            <div style="width: 20%;">
                                <button class="btn btn-sm btn-default" name="btn_product" type="button"
                                    onclick="searchProduct()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive" id="table-container">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="text-align: center; align-items: center">Mã sản phẩm</th>
                            <th style="text-align: center; align-items: center">Tên sản phẩm</th>
                            <th style="text-align: center; align-items: center">Danh mục</th>
                            <th style="text-align: center; align-items: center">Giá</th>
                            <th style="text-align: center; align-items: center">Đã bán</th>
                            <th style="text-align: center; align-items: center">Hình Ảnh</th>
                            <th style="text-align: center; align-items: center">Trạng thái</th>
                            <th style="text-align: center; align-items: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_all_product as $key => $product)
                            <tr>
                                <td style="text-align: center; align-items: center">{{ $product->product_id }}</td>
                                <td style="text-align: center; align-items: center">{{ $product->product_name }}</td>
                                <td style="text-align: center; align-items: center">{{ $product->category_name }}</td>
                                <td style="text-align: center; align-items: center">{{ $product->product_price }}</td>
                                <td style="text-align: center; align-items: center">{{ $product->product_sold }}</td>
                                <td style="text-align: center; align-items: center"><img
                                        src="public/uploads/product/{{ $product->product_image }}" height="100"
                                        width="150"></td>
                                <td style="text-align: center; align-items: center">
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
                                <td style="text-align: center; align-items: center">
                                    <div>
                                        <a href="{{ URL::to('/edit-product/' . $product->product_id) }}"
                                            class="active styling-edit hover-edit-product" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                            href="{{ URL::to('/delete-product/' . $product->product_id) }}"
                                            class="active styling-delete hover-delete-product" ui-toggle-class="">
                                            <i class="fa fa-times text-danger text"></i>
                                        </a>
                                    </div>

                                    <div>
                                        <a href="{{ URL::to('/show-add-image/' . $product->product_id) }}"
                                            class="active styling-edit hover-add-image" ui-toggle-class="">
                                            <i class="fa fa-image text-success text-active"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <footer class="panel-footer">
                    <div class="clearfix">
                        {{ $get_all_product->links() }}
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
