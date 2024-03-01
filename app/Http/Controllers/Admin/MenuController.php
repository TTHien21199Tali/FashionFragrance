<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;
use LDAP\Result;

use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService) //them 1 danh mục con từ danh mục cha     
    {
        $this->menuService = $menuService;
    }

    //
    public function create(){
        return view('admin.menu.add',[
            'title'=>'Thêm Danh Mục Mới',

            //them 1 danh mục con từ danh mục cha
            'menus'=>$this->menuService->getParent() // vs menuService.php
        ]);
    }

    public function store(CreateFormRequest $request){
        //dd($request->input());
        $this->menuService->create($request);

        return redirect()->back();     
    }

    public function index(){
        return view('admin.menu.list',[
            'title'=>'Danh Sách Danh Mục Mới Nhất',
            'menus'=>$this->menuService->getAll() 
            //khi cần thiết có thẻ sửa menus thành menu
        ]);
    }

        /*public function show(Menu $menu)
        {          
            return view('admin.menu.edit',[
                'title'=>'Chỉnh Sửa Danh Mục:'.$menu->name,
                'menu'=>$menu
            ]);
        }*/

    public function edit(Menu $menu)
    {
        $menus=$this->menuService->getAll();
        return view('admin.menu.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' . $menu->name,
            'menu' => $menu,//chứa thông tin đối tượng sửa
            'menus' => $menus,//chứa thông tin tất cả trong csdl
        ]);
    }

    public function update(Request $request, Menu $menu)
    {

        if ($request->parent_id == $menu->id) {
            $request->offsetUnset('parent_id');
        }
        
        $menu->update($request->all());

        return redirect('/admin/menu/list')->with('success', 'Cập nhật thành công');
    }


    public function destroy(Request $request): JsonResponse
    {
        $id = (int) $request->input('id');
        $menu = Menu::find($id);

        if ($menu) {
            Menu::where('id', $id)->orWhere('parent_id', $id)->delete();

            return response()->json([
                'error' => false,
                'message' => 'Xóa Thành Công Danh Mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    
}
    