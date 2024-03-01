

@extends('admin.main')

@section('header')
    <script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
@endsection

@section('content')
<form action="{{ url('/admin/menu/update/' . $menu->id) }}" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tên Danh Mục</label>
            <input type="text" name="name" value="{{$menu->name}}" class="form-control" id="menu" placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group">
            <label for="menu">Danh Mục</label>
            <select class="form-control" id="parent_id" name="parent_id">
                @if(isset($menus) && count($menus) > 0)
                    <option value="0" {{$menu->parent_id==0 ? 'selected':''}}>Danh mục cha</option>
                    @foreach($menus as $menuParent)
                        <option value="{{$menuParent->id}}" {{$menu->parent_id == $menuParent->id ? 'selected':''}}>{{$menuParent->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        
        <div class="form-group">
            <label >Mô Tả</label>
            <textarea id="description" name="description" class="form-control">{{$menu->description}}</textarea>
        </div>

        <div class="form-group">
            <label >Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control">{{$menu->content}}</textarea> <!--id dc copy từ footer-->
        </div>

        <div class="form-group">
            <label for="">Kích Hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$menu->active==1 ? 'checked=""':''}}>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" value="0" id="no_active" name="active" {{$menu->active==0 ? 'checked=""':''}} >
                <label for="no_active" class="custom-control-label">Không</label>
            </div>
        </div>  
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
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
            