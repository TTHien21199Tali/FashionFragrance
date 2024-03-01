

@extends('admin.main')

@section('header')
    <script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
@endsection

@section('content')
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    <div class="card-body">
    
        <div class="form-group">
            <label for="product">Tên Sản Phẩm</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="product" placeholder="Nhập tên sản phẩm">
        </div>

        <div class="form-group">
            <label for="product">Danh Mục</label>
            <select class="form-control" id="menu_id" name="menu_id">
                <option value="0">Danh mục cha</option>
                @foreach($menus as $menuItem)
                    <option value="{{$menuItem->id}}" {{$product->menu_id == $menuItem->id ? 'selected':''}}>{{$menuItem->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product">Giá Gốc</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="Nhập giá sản phẩm">
        </div>

        <div class="form-group">
            <label for="product">Giá Giảm</label>
            <input type="number" name="price_sale" class="form-control" value="{{ $product->price_sale }}" placeholder="Nhập giá giảm của sản phẩm">
        </div>
        
        <div class="form-group">
            <label for="product">Mô Tả</label>
            <textarea id="description" name="description" class="form-control" placeholder="Nhập mô tả cho sản phẩm">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="product" >Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control" placeholder="Nhập mô tả chi tiết">{{ $product->content }}</textarea> <!--id dc copy từ footer-->
        </div>

        <div class="form-group">
            <label for="product">Ảnh Sản Phẩm</label>
            <input type="file" name="file" class="form-controll" id="upload"  onchange="displaySelectedImage()"><br>
            
            @if($product->thumb)
                <!--<img id="productImage" src="{{ asset("storage/image/products/{$product->thumb}") }}" alt="Product Image" >-->
                <div class="image-container_product">
                <img id="previewImage" src="{{ asset("image/products/$product->thumb") }}" alt="Product Image" >
                </div>
            @endif   
        </div>

        <div class="form-group">
            <label for="product">Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$product->active==1 ? 'checked=""':''}}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" {{$product->active==0 ? 'checked=""':''}}>
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>  
        
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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
