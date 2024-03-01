<?php

namespace App\Http\Services\Menu;
use App\Models\Menu;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Session;//import cho Session và flash

class MenuService
{
    
    public function getParent(){  //
        return Menu::where('parent_id',0)->get(); //luồng tiếp theo qua view add
        /*return Menu::when($parent_id ==0, function($query) use ($parent_id){
            $query->where('parent_id',$parent_id);
        });
        ->get();*/
    }

    //lâý danh sách menu
    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);//phân trang cho menu trong trường hợp nhiều
    }

    //show home //lấy phần cần thiết
    public function show()
    {
        return Menu::select('name','id','description', 'thumb') //lấy những thông tin cần thiết từ csdl 
            ->where('parent_id',0)
            ->orderbyDesc('id')
            ->get();
    }

    public function create($request){
        //insret toàn bộ thông tin từ form vào bảng csdl;
        try{
            Menu::create([
                //'title'chứa: name|id=>(string) $request->input('name'chư: name|id ),
                'name'=>(string) $request->input('name'),
                'parent_id'=>(int) $request->input('parent_id'),
                'content'=>(string) $request->input('content'),
                'active'=>(string) $request->input('active'),
                'description'=>(string) $request->input('name'),
                'slug'=>Str::slug($request->input('name'),'-')
            ]);
            Session::flash('success', 'Tạo Danh Mục Thành Công');
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;     
    }


    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::find($id); 

        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }
 
}

/* se dùng lệnh code này khi dự án hoàn thành
    public function create($request)
    {
        try {
            $slug = Str::slug($request->input('name'), '-');

            // Kiểm tra xem 'slug' đã tồn tại chưa
            if (Menu::where('slug', $slug)->exists()) {
                // Nếu tồn tại, thực hiện một logic hoặc thông báo cần thiết
                Session::flash('error', 'Slug đã tồn tại. Vui lòng chọn tên khác.');
                return false;
            }

            // Nếu 'slug' không tồn tại, tiếp tục tạo mới
            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active'),
                'description' => (string)$request->input('name'),
             'slug' => $slug,
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }*/