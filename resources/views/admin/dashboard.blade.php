 @extends('admin_layout')
 @section('admin_content')
     <h3>Chào mừng bạn đến với Trang quản trị</h3>
     <h1>Lọc theo ngày tháng năm</h1>
     <form id="filter-form" action="{{ URL::to('filter-dashboard') }}" method="POST">
         {{ csrf_field() }}
         <label for="start-date">Ngày bắt đầu:</label>
         <input type="date" id="start-date" name="start_date">

         <label for="end-date">Ngày kết thúc:</label>
         <input type="date" id="end-date" name="end_date">

         <button type="submit">Lọc</button>
     </form>

     <div id="result-container"></div>
 @endsection
