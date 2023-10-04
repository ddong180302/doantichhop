    @extends('admin_layout')
    @section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhập danh mục sản phẩm
                    </header>
                    @if (session('message'))
                        <script>
                            toastify().success('{{ session('message') }}');
                        </script>
                    @endif
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form"
                                action="{{ URL::to('/update-category-product/' . $edit_category_product->category_id) }}"
                                method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control"
                                        value="{{ $edit_category_product->category_name }}" name="category_name">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả danh mục</label>
                                    <textarea style="resize:none" rows="8" class="form-control" name="category_desc">{{ $edit_category_product->category_desc }}
                                    </textarea>
                                </div>
                                <button type="submit" name="update_category" class="btn btn-info">
                                    Cập Nhật Danh Mục
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @endsection
