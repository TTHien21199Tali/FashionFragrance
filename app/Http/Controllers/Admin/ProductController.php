<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Product\UploadService;
use Illuminate\Support\Facades\Session;
use App\Models\Menu;

use App\Models\Product;


class ProductController extends Controller
{
    //
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }
   
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $perPage = 5;
        //$products = Product::all(); // Lấy danh sách sản phẩm
        $products = Product::paginate($perPage);

        // Gọi phương thức get từ service
        $serviceProducts = $this->uploadService->get(); 

        return view('admin.product.list', [
            'title'=>'Danh Sách Danh Mục Mới Nhất',
            'products' => $products,
            'serviceProducts' => $serviceProducts, // Trả kết quả của hàm get từ service
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $menus = Menu::all();

        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $menus, // Truyền giá trị của biến $menus cho view
        ]);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UploadService $uploadService)
    {
        
    try {
        $request->validate([
            'name' => 'required',
            'menu_id' => 'required',
            'price' => 'required|numeric|min:0', // Giá phải là số và lớn hơn hoặc bằng 0
            'price_sale' => 'nullable|required|numeric|min:0|max:'.$request->input('price'), // Giá sale có thể để trống, nhưng nếu có thì phải là số, lớn hơn hoặc bằng 0 và nhỏ hơn hoặc bằng giá gốc
            'description' => 'required',
            'content' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'required|in:0,1',
        ], [
            //thông báo theo từng lỗi
            'name.required' => 'Tên sản phẩm không được để trống.',
            'menu_id.required' => 'Danh mục không được để trống.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'price.numeric' => 'Giá sản phẩm phải là số.',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'price_sale.numeric' => 'Giá giảm phải là số.',
            'price_sale.min' => 'Giá giảm phải lớn hơn hoặc bằng 0.',
            'price_sale.max' => 'Giá giảm không thể lớn hơn giá gốc.',
            'price_sale.required'=>'Giá khuyến mãi sản phẩm không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
            'content.required' => 'Mô tả chi tiết không được để trống.',
            'file.image' => 'Ảnh sản phẩm phải là hình ảnh.',
            'file.mimes' => 'Định dạng ảnh không hợp lệ.',
            'file.max' => 'Kích thước ảnh quá lớn.',
            'active.required' => 'Trạng thái kích hoạt không được để trống.',
            'active.in' => 'Trạng thái kích hoạt không hợp lệ.',
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->menu_id = $request->input('menu_id');
        $product->price = $request->input('price');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        $product->content = $request->input('content');
        $product->active = $request->input('active');

        $uploadResult = $uploadService->uploadImage($request, $product);

        if ($uploadResult) {
            // Upload ảnh thành công, lưu thông tin sản phẩm
            if ($product->save()) {
                Session::flash('success', 'Thêm sản phẩm thành công');
                return redirect()->route('products.create');
            } else {
                Session::flash('error', 'Không thể thêm sản phẩm. Vui lòng thử lại.');
            }
        } else {
            // Có lỗi trong quá trình upload ảnh
            Session::flash('error', 'Không thể tải lên ảnh.');
        }

    } catch (\Exception $err) {
        Session::flash('error', $err->getMessage());
    }

    return redirect()->back()->withInput();

        // Gọi service để xử lý upload ảnh
        /*$uploadService->uploadImage($request, $product);

        if ($product->save()) {
            Session::flash('success', 'Thêm sản phẩm thành công');
            return redirect()->route('products.create');
        } else {
            Session::flash('error', 'Không thể thêm sản phẩm. Vui lòng thử lại.');
            return redirect()->back();
        }
        
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            //return false;
            return redirect()->back();
        }*/
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::find($id);

        if (!$product) {
            // Xử lý khi không tìm thấy sản phẩm
        }

        $menus = Menu::all();

        return view('admin.product.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm: ' . $product->name,
            'product' => $product, // Truyền thông tin sản phẩm vào view
            'menus' => $menus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $request->validate([
                'name' => 'required',
                'menu_id' => 'required',
                'price' => 'required|numeric|min:0',
                'price_sale' => 'nullable|required|numeric|min:0|max:'.$request->input('price'),
                'description' => 'required',
                'content' => 'required',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'active' => 'required|in:0,1',
            ], [
                'name.required' => 'Tên sản phẩm không được để trống.',
                'menu_id.required' => 'Danh mục không được để trống.',
                'price.required' => 'Giá sản phẩm không được để trống.',
                'price.numeric' => 'Giá sản phẩm phải là số.',
                'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
                'price_sale.numeric' => 'Giá giảm phải là số.',
                'price_sale.min' => 'Giá giảm phải lớn hơn hoặc bằng 0.',
                'price_sale.max' => 'Giá giảm không thể lớn hơn giá gốc.',
                'price_sale.required'=>'Giá khuyến mãi sản phẩm không được để trống.',
                'description.required' => 'Mô tả không được để trống.',
                'content.required' => 'Mô tả chi tiết không được để trống.',
                'file.image' => 'Ảnh sản phẩm phải là hình ảnh.',
                'file.mimes' => 'Định dạng ảnh không hợp lệ.',
                'file.max' => 'Kích thước ảnh quá lớn.',
                'active.required' => 'Trạng thái kích hoạt không được để trống.',
                'active.in' => 'Trạng thái kích hoạt không hợp lệ.',
            ]);
    
            $product = Product::find($id);
    
            if ($product) {
                $product->update($request->all());
                ///
                $this->uploadService->uploadImage($request, $product);
                //
                Session::flash('success', 'Cập nhật sản phẩm thành công');
                return redirect('/admin/products/list');
            } else {
                Session::flash('error', 'Không tìm thấy sản phẩm');
            }
    
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
    
        return redirect()->back()->withInput();
        
    }

    /**
     * Remove the specified resource from storage.
     */
     
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['error' => false, 'message' => 'Xóa sản phẩm thành công']);
        } else {
            return response()->json(['error' => true, 'message' => 'Không tìm thấy sản phẩm']);
        }       
    }

    #load more
    const LIMIT=8; // số lượng sản phâm
    public function loadMore(Request $request)
    {
        $page = $request->input('page', null); // Mặc định là 1 nếu không có giá trị
        $products = Product::orderByDesc('id')
            ->skip(($page) * self::LIMIT)
            ->take(self::LIMIT)
            ->get();

        // Kiểm tra xem đã load hết sản phẩm hay chưa
        if ($products->isEmpty()) {
            if ($page == 1) {
                return response()->json(['message' => 'No products found'], 404);
            } else {
                return response()->json(['message' => 'No more products to load'], 404);
            }
        }

        // Trả về danh sách sản phẩm đã load
        return view('products.list', compact('products'))->render();
    }
}
