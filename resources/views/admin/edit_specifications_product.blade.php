@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thông số kỹ thuật sản phẩm
                </header>
                <div class="panel-body">
                    @foreach ($edit_product as $key => $edit_value)
                        <div class="position-center">
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<div class="text-alert">', $message, '</div>';
                                Session::put('message', null);
                            }
                            ?>
                            <form role="form"
                                action="{{ URL::to('/update-specifications-product/' . $edit_value->product_id) }}"
                                method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input type="text" class="form-control" value="{{ $edit_value->product_name }}"
                                        name="product_name">
                                </div>
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input type="text" class="form-control" value="{{ $edit_value->product_price }}"
                                        name="product_price">
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail">
                                    <img src="{{ URL::to('public/uploads/product/' . $edit_value->product_image) }}"
                                        height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả sản phẩm</label>
                                    <textarea style="resize:none" rows="8" class="form-control" name="product_desc">{{ $edit_value->product_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung sản phẩm</label>
                                    <textarea style="resize:none" rows="8" class="form-control" name="product_content">{{ $edit_value->product_content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục sản phẩm</label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                        @foreach ($cate_product as $key => $cate)
                                            @if ($cate->category_id == $edit_value->category_id)
                                                <option selected value="{{ $cate->category_id }}">{{ $cate->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thương hiệu sản phẩm</label>
                                    <select name="brand_id" class="form-control input-sm m-bot15">
                                        @foreach ($brand_product as $key => $brand)
                                            @if ($brand->brand_id == $edit_value->brand_id)
                                                <option selected value="{{ $brand->brand_id }}">{{ $brand->brand_name }}
                                                </option>
                                            @else
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hiển thị sản phẩm</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
