    @extends('admin_layout')
    @section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhập danh mục sản phẩm
                    </header>
                    <div class="panel-body">
                        @foreach ($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo '<div class="text-alert">', $message, '</div>';
                                    Session::put('message', null);
                                }
                                ?>
                                <form role="form"
                                    action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}"
                                    method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" class="form-control" value="{{ $edit_value->category_name }}"
                                            name="category_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả danh mục</label>
                                        <textarea style="resize:none" rows="8" class="form-control" name="category_product_desc"
                                            id="exampleInputPassword1">{{ $edit_value->category_desc }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa danh mục</label>
                                        <textarea style="resize:none" rows="8" class="form-control" name="category_product_desc"
                                            id="exampleInputPassword1">{{ $edit_value->meta_keywords }}</textarea>
                                    </div>
                                    <button type="submit" name="update_category_product" class="btn btn-info">Cập Nhật Danh
                                        Mục</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    @endsection
