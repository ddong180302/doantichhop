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
             @foreach ($filter_category as $key => $cate_pro)
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
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
