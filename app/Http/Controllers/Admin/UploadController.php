<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Product\UploadService; // Fix the namespace
use App\Models\Product;

class UploadController extends Controller
{
    protected $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /*public function store(Request $request)
    {
        $product = new Product(); // Tạo đối tượng Product để truyền vào hàm uploadImage
        $result = $this->uploadService->uploadImage($request, $product);

        if ($result) {
            return redirect()->back()->with('image_path', $result);
        } else {
            return redirect()->back()->with('error', 'Không thể tải lên ảnh.');
        }
    }*/

    public function store(Request $request)
    {
        $product = new Product();
        $result = $this->uploadService->uploadImage($request, $product);
    
        if ($result) {
            return redirect()->back()->with('image_filename', $product->thumb);
        } else {
            return redirect()->back()->with('error', 'Không thể tải lên ảnh.');
        }
    }

    
}
