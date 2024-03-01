

@extends('admin.main')

@section('header')
    <script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
@endsection

@section('content')
<form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="slider">Tiêu Đề</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="slider" placeholder="Nhập tên tiêu đề">
        </div>

        <div class="form-group">
            <label for="slider">Đường Dẫn</label>
            <input type="text" name="url" value="{{old('url')}}" class="form-control" id="url" placeholder="Nhập đường đẫn">
        </div>

        <div class="form-group">
            <label for="slider">Sắp Xếp</label>
            <input type="number" name="sort_by" class="form-control" value="{{ old('sort_by') }}" >
        </div>
        
        <div class="form-group">
            <label for="product">Ảnh Sản Phẩm</label>
            <input type="file" name="file" class="form-controll" id="upload" onchange="displaySelectedImage();">
            <div class="image-container">
                <img id="previewImage" src="#" alt="Preview Image" style="display: none;" >
            </div>
        </div>

        <div class="form-group">
            <label for="slider">Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{ old('active',1) == 1 ? 'checked' : '' }}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" {{ old('active',1) == 0 ? 'checked' : '' }}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>       
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Slider</button>
    </div>
</form>
    @csrf
@endsection

@section('footer')
    <script>
        ClassicEditor//phương thức sử dụng CKEditor 5
            .create(document.querySelector('#content'))
            .catch(error => {
                //console.error(error);//đóng khi dùng ckeditor
            });
    </script>
@endsection
