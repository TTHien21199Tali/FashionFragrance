

@extends('admin.main')

@section('header')
    <script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
@endsection

@section('content')
<form action="{{ route('sliders.update', ['id' => $slider->id]) }}" method="POST" enctype="multipart/form-data">
    <div class="card-body">
        <div class="form-group">
            <label for="slider">Tiêu Đề</label>
            <input type="text" name="name" value="{{ $slider->name }}" class="form-control" id="slider" placeholder="Nhập tên tiêu đề">
        </div>

        <div class="form-group">
            <label for="slider">Đường Dẫn</label>
            <input type="text" name="url" value="{{$slider->url}}" class="form-control" id="url" placeholder="Nhập đường đẫn">
        </div>

        <div class="form-group">
            <label for="slider">Sắp Xếp</label>
            <input type="number" name="sort_by" class="form-control" value="{{ $slider->sort_by }}" >
        </div>
        
        <div class="form-group">
            <label for="product">Ảnh Sản Phẩm</label>
            <input type="file" name="file" class="form-controll" id="upload" onchange="displaySelectedImage();"><br>
            @if($slider->thumb)
            <div class="image-container_slider">
                <!--<img id="previewImage" src="{{ asset("storage/image/sliders/{$slider->thumb}") }}" alt="Preview Image" >-->
                <img id="previewImage" src="{{ asset("image/sliders/$slider->thumb") }}" alt="Preview Image" >
            </div>
            @endif
        </div>

        <div class="form-group">
            <label for="slider">Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$slider->active==1 ? 'checked=""':''}}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" {{$slider->active==0 ? 'checked=""':''}}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>       
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật hình ảnh</button>
    </div>
</form>
    @csrf
@endsection

@section('footer')
    <script>
        ClassicEditor//phương thức sử dụng CKEditor 5
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
