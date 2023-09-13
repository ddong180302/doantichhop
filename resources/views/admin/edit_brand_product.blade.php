    @extends('admin_layout')
    @section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhập thương hiệu sản phẩm
                    </header>
                    <div class="panel-body">
                        @foreach ($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    toastify()->success('Cập nhật thương hiệu sản phẩm thành công!');
                                    Session::put('message', null);
                                }
                                ?>
                                <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}"
                                    method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Tên thương hiệu</label>
                                        <input type="text" class="form-control" value="{{ $edit_value->brand_name }}"
                                            name="brand_product_name" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả thương hiệu</label>
                                        <textarea style="resize:none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1">{{ $edit_value->brand_desc }}</textarea>
                                    </div>
                                    <button type="submit" name="update_brand_product" class="btn btn-info">Cập Nhật Thương
                                        Hiệu</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    @endsection
