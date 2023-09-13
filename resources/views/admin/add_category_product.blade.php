@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <?php
                        $message = Session::get('message');
                        if ($message) {
                            toastify()->success('Your action was successful!');
                            Session::put('message', null);
                        }
                        ?>
                        <form role="form" action="{{ URL::to('/save-category-product') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" class="form-control" name="category_product_name"
                                    id="exampleInputEmail1" placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label>Mô tả danh mục</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="category_product_desc"
                                    id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tên đường dẫn</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="slug_category_product"
                                    id="exampleInputPassword1" placeholder="slug"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Từ khóa danh mục</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="category_product_keywords"
                                    id="exampleInputPassword1" placeholder="Từ khóa danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label>category_product_parent</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="category_product_parent"
                                    id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label>category_orders</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="category_orders" id="exampleInputPassword1"
                                    placeholder="Mô tả danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select name="category_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                </select>
                            </div>

                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection
