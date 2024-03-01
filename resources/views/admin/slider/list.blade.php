


@extends('admin.main')

@section('content')

    <form method="POST" action="{{asset('App/helpers/Helper')}}"> 
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Tiêu Đề</th>
                    <th>Đường Dẫn</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Cập Nhật</th>
                    <th style="width:100px"></th>
                </tr>
            </thead>
            <tbody>
                <!--dùng !! để biên dịch HTML-->
                {!! \App\Helpers\Helper::sliderList($sliders) !!} 
            </tbody>
        </table>
    </form>
    
@endsection


