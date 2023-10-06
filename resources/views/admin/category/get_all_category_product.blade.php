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
                Liệt kê danh mục sản phẩm
            </div>
            <div class="row w3-res-tb" style="margin-bottom: 30px">
                <div class="col-sm-7 m-b-xs">
                    <form action="">
                        @csrf
                        <select name="filter_category" id="filter-category"
                            style="padding: 10px; border: 1px solid #333; border-radius: 5px">
                            <option>--Lọc Theo--</option>
                            <option value="{{ URL::to('/filter-category') }}?sort_by=moinhat">Mới Nhất</option>
                            <option value="{{ URL::to('/filter-category') }}?sort_by=tuA_Z">Từ A-Z</option>
                            <option value="{{ URL::to('/filter-category') }}?sort_by=tuZ_A">Từ Z-A</option>
                        </select>
                    </form>
                </div>
                <div class="col-sm-5">
                    <form action="{{ URL::to('/search-cate') }}" method="POST">
                        {{ csrf_field() }}
                        <div style="width: 100%; display: flex; flex-direction: row">
                            <div style="width: 80%">
                                <input type="text" name="key_cate" class="input-sm form-control"
                                    placeholder="Tìm kiếm theo tên">
                            </div>
                            <div style="width: 20%;">
                                <button class="btn btn-sm btn-default" name="btn_product" type="button"
                                    onclick="searchCategory()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive" id="table-category-container">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="text-align: center; align-items: center">Mã danh mục</th>
                            <th style="text-align: center; align-items: center">Tên danh mục</th>
                            <th style="text-align: center; align-items: center">Trạng thái</th>
                            <th style="text-align: center; align-items: center">Ngày tạo</th>
                            <th style="text-align: center; align-items: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($get_all_category_product as $key => $cate_pro)
                            <tr>
                                <td style="text-align: center; align-items: center">{{ $cate_pro->category_id }}</td>
                                <td style="text-align: center; align-items: center">{{ $cate_pro->category_name }}</td>
                                <td style="text-align: center; align-items: center">
                                    <span class="text-ellipsis">
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
                                    </span>
                                </td>
                                <td style="text-align: center; align-items: center">{{ $cate_pro->created_at }}</td>
                                <td style="text-align: center; align-items: center">
                                    <a href="{{ URL::to('/edit-category-product/' . $cate_pro->category_id) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    {{-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')"
                                        href="{{ URL::to('/delete-category-product/' . $cate_pro->category_id) }}"
                                        class="active styling-delete" ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <footer class="panel-footer">
                    <div class="clearfix">
                        {{ $get_all_category_product->links() }}
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
