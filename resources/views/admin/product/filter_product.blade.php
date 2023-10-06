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
            @foreach ($filtered_products as $key => $product)
                <tr>
                    <td style="text-align: center; align-items: center">{{ $product->product_id }}</td>
                    <td style="text-align: center; align-items: center">{{ $product->product_name }}</td>
                    <td style="text-align: center; align-items: center">{{ $product->category_name }}</td>
                    <td style="text-align: center; align-items: center">{{ $product->product_price }}</td>
                    <td style="text-align: center; align-items: center">{{ $product->product_sold }}</td>
                    <td style="text-align: center; align-items: center"><img
                            src="public/uploads/product/{{ $product->product_image }}" height="100" width="150">
                    </td>
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
                        <a href="{{ URL::to('/edit-product/' . $product->product_id) }}" class="active styling-edit"
                            ui-toggle-class="">
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
