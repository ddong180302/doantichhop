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
                Liệt kê phương thức thanh toán
            </div>
            <div class="row w3-res-tb" style="margin-bottom: 30px">
                <div class="col-sm-7 m-b-xs">
                </div>
                <div class="col-sm-5">
                    <form action="{{ URL::to('/search-payment') }}" method="POST">
                        {{ csrf_field() }}
                        <div style="width: 100%; display: flex; flex-direction: row">
                            <div style="width: 80%">
                                <input type="text" name="key_payment" class="input-sm form-control"
                                    placeholder="Tìm kiếm theo tên">
                            </div>
                            <div style="width: 20%;">
                                <button class="btn btn-sm btn-default" name="btn_payment" type="button"
                                    onclick="searchPayment()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                        @foreach ($get_all_payment as $key => $payment)
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
                                    <a href="{{ URL::to('/show-edit-payment/' . $payment->payment_id) }}"
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
                        {{ $get_all_payment->links() }}
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
