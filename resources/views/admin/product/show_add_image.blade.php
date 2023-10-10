@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @if (session('message'))
                            <script>
                                toastify().success('{{ session('message') }}');
                            </script>
                        @endif
                        <form action="{{ URL::to('/add-image-product/' . $product_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="images[]" multiple accept="image/*" required>
                            <button type="submit">Upload</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
