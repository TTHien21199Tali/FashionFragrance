

@extends('admin.main')

@section('content')
<!--action="{{asset('App/helpers/Helper')}}"-->
    <form method="POST" action="App/helpers/Helper"> 
    @csrf
    <table class="table">
        <thead>
            <tr >
                <th style="width:50px ">ID</th>
                <th>Tên Danh Mục</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật</th>
                <th style="width:100px"></th>
            </tr>
        </thead>
        <tbody>
            <!--dùng !! để biên dịch HTML-->
            {!! \App\Helpers\Helper::menu($menus) !!} 
        </tbody>
    </table>
    </form>
    
@endsection


