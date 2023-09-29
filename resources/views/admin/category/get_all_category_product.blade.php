@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
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
                            <th>Mã danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_all_category_product as $key => $cate_pro)
                            <tr>
                                <td>{{ $cate_pro->category_id }}</td>
                                <td>{{ $cate_pro->category_name }}</td>
                                <td><span class="text-ellipsis">
                                        <?php
                                                 if($cate_pro->category_status==1){
                                            ?>
                                        <a href="{{ URL::to('/unactive-category-product/' . $cate_pro->category_id) }}">
                                            Hiển Thị
                                            <?php
                                                }else{
                                                    ?>
                                            <a href="{{ URL::to('/active-category-product/' . $cate_pro->category_id) }}">
                                                Ẩn
                                                <?php
                                                }
                                          ?>
                                    </span></td>
                                <td>
                                    <a href="{{ URL::to('/edit-category-product/' . $cate_pro->category_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')"
                                        href="{{ URL::to('/delete-category-product/' . $cate_pro->category_id) }}"
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
                    {{ $get_all_category_product->links() }}
                </div>
            </footer>
        </div>
    </div>
@endsection
