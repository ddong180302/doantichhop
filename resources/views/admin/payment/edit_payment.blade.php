    @extends('admin_layout')
    @section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhập phương thức thanh toán
                    </header>
                    @if (session('message'))
                        <script>
                            toastify().success('{{ session('message') }}');
                        </script>
                    @endif
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" action="{{ URL::to('/edit-payment/' . $edit_payment->payment_id) }}"
                                method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên phương thức</label>
                                    <input type="text" class="form-control" value="{{ $edit_payment->payment_method }}"
                                        name="payment_method">
                                </div>
                                <button type="submit" name="edit_payment" class="btn btn-info">
                                    Cập Nhật Phương Thức
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
