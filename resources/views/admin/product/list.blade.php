

@extends('admin.main')

@section('content')

    <form method="POST" action="{{asset('App/helpers/Helper')}}"> 
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh Mục</th>
                    <th>Giá Gốc</th>
                    <th>Giá Khuyến Mãi</th>
                    <th>Ảnh</th>
                    <th>Trạng Thái</th>
                    <th style="width:100px"></th>
                </tr>
            </thead>
            <tbody>
                <!--dùng !! để biên dịch HTML-->
                {!! \App\Helpers\Helper::productList($products) !!} 
            </tbody>
        </table>
    </form>
    <!-- Hiển thị giao diện phân trang -->
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item{{ $products->currentPage() == 1 ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item{{ $i == $products->currentPage() ? ' active' : '' }}">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item{{ $products->currentPage() == $products->lastPage() ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
    
@endsection


