

@extends('admin.main')

@section('header')
    <script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên Danh Mục</label>
            <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group">
            <label for="menu">Danh Mục</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="0">Danh mục cha</option>
                @foreach($menus as $menuItem)
                    <option value="{{$menuItem-> id}}">{{$menuItem->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label >Mô Tả</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label >Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control"></textarea> <!--id dc copy từ footer-->
        </div>

        <div class="form-group">
            <label for="">Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked="">
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>  
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
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
