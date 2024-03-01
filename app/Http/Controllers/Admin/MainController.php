<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Services\Product\UploadService;


class MainController extends Controller
{
    //
    /*
    protected $product;
    
    public function __construct(UploadService $product)
    {
        $this->product = $product;
    }*/

    /*
    public function index(){
        return view('admin.home',[
            'title'=>'Trang Quản Trị Admin',
            //'products' => $this->product->get()
        ]);
    }
    */

    
    //phân trang
    public function index() {
        $products = Product::paginate(16);
        return view('admin.home', [
            'title' => 'Trang Quản Trị Admin', 
            'products' => $products
        ]);
    }

}
