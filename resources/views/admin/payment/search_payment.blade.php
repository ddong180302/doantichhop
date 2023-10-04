 <div class="table-responsive" id="table-payment-container">
     <table class="table table-striped b-t b-light">
         <thead>
             <tr>
                 <th style="text-align: center; align-items: center">Mã phương thức</th>
                 <th style="text-align: center; align-items: center">Tên phương thức</th>
                 <th style="text-align: center; align-items: center">Trạng thái</th>
                 <th style="text-align: center; align-items: center">Ngày tạo</th>
                 <th style="text-align: center; align-items: center">Hành động</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($search_payment as $key => $payment)
                 <tr>
                     <td style="text-align: center; align-items: center">{{ $payment->payment_id }}</td>
                     <td style="text-align: center; align-items: center">{{ $payment->payment_method }}</td>
                     <td style="text-align: center; align-items: center">
                         <span class="text-ellipsis">
                             <?php
                                                 if($payment->payment_status==1){
                                            ?>
                             <a href="{{ URL::to('/unactive-payment/' . $payment->payment_id) }}">
                                 Hiển Thị
                                 <?php
                                                }else{
                                                    ?>
                                 <a href="{{ URL::to('/active-payment/' . $payment->payment_id) }}">
                                     Ẩn
                                     <?php
                                                }
                                          ?>
                         </span>
                     </td>
                     <td style="text-align: center; align-items: center">{{ $payment->created_at }}</td>
                     <td style="text-align: center; align-items: center">
                         <a href="{{ URL::to('/edit-payment-product/' . $payment->payment_id) }}"
                             class="active styling-edit" ui-toggle-class="">
                             <i class="fa fa-pencil-square-o text-success text-active"></i>
                         </a>
                         {{-- <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')"
                                        href="{{ URL::to('/delete-payment-product/' . $cate_pro->payment_id) }}"
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
             {{ $search_payment->links() }}
         </div>
     </footer>
 </div>
