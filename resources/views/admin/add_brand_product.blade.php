@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thương hiệu sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            toastify()->success('Thêm thương hiệu sản phẩm thành công!');
                            Session::put('message', null);
                        }
                        ?>
                        <form role="form" action="{{ URL::to('/save-brand-product') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên thương hiệu</label>
                                <input type="text" class="form-control" name="brand_product_name" id="exampleInputEmail1"
                                    placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label>Mô tả thương hiệu</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1"
                                    placeholder="Mô tả danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Brand slug</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="brand_slug" id="exampleInputPassword1"
                                    placeholder="Mô tả danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm Thương Hiệu</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
