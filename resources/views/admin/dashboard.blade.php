 @extends('admin_layout')
 @section('admin_content')
     <h2 style="text-align: center; padding: 30px 0;">Chào mừng bạn đến với Trang quản trị</h2>
     <form id="filter-form" action="{{ URL::to('/filter-dashboard') }}" method="POST">
         {{ csrf_field() }}
         <div style="display: flex; flex-direction: row; gap: 20px; ">
             <div>
                 <label for="start-date">Ngày bắt đầu:</label>
                 <input style="padding: 5px; border-radius: 5px; outline: none; border: none" type="date" id="start-date"
                     name="start_date">
             </div>

             <div>
                 <label for="end-date">Ngày kết thúc:</label>
                 <input style="padding: 5px; border-radius: 5px; outline: none; border: none" type="date" id="end-date"
                     name="end_date">

             </div>
             <div>
                 <button style="padding: 7px 30px; border-radius: 5px; outline: none; border: none; font-size: 16px;"
                     class="btn btn-sm btn-default" name="btn_product" type="button"
                     onclick="filterDashboard()">Lọc</button>
             </div>
         </div>
     </form>

     <div style="width:100%; display: flex; flex-direction: row; gap: 30px">
         <div style="width: 50%">
             <h3 style="padding: 30px 0; text-align: center">Bảng Thống Kê Tổng</h3>
             <table style="border-collapse: collapse; width: 100%;">
                 <tbody style="border: 2px solid #333;">
                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số khách hàng
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span
                                 style="font-size: 14pt; font-family: 'times new roman', times;">{{ $users }}</span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số đơn hàng
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span
                                 style="font-size: 14pt; font-family: 'times new roman', times;">{{ $countOrder }}</span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng sản phẩm đã bán
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 {{ $sumProductOrder }}
                             </span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số sản phẩm còn trong kho
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 {{ $AllQuantityProduct }}
                             </span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số sản phẩm đã nhập
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span
                                 style="font-size: 14pt; font-family: 'times new roman', times;">{{ $AllProductImport }}</span>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>
         <div id="filter-statistical" style="width: 50%">
             <h3 style="padding: 30px 0; text-align: center">Bảng Thống Kê Theo Ngày Tháng</h3>
             <h3 style="padding: 30px 0; text-align: center">Trống</h3>
             {{-- <table style="border-collapse: collapse; width: 100%;">
                 <tbody style="border: 2px solid #333;">
                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số khách hàng
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span
                                 style="font-size: 14pt; font-family: 'times new roman', times;">{{ $users }}</span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số đơn hàng
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span
                                 style="font-size: 14pt; font-family: 'times new roman', times;">{{ $countOrder }}</span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng sản phẩm đã bán
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 {{ $sumProductOrder }}
                             </span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số sản phẩm còn trong kho
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 {{ $AllQuantityProduct }}
                             </span>
                         </td>
                     </tr>

                     <tr style="height: 60px; border: 2px solid #333;">
                         <td style="width: 70%; height: 60px; padding:30px">
                             <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                 Tổng số sản phẩm đã nhập
                             </span>
                         </td>
                         <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                             <span
                                 style="font-size: 14pt; font-family: 'times new roman', times;">{{ $AllProductImport }}</span>
                         </td>
                     </tr>
                 </tbody>
             </table> --}}
         </div>
     </div>
 @endsection
