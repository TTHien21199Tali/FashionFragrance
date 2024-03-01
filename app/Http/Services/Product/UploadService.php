<?php

namespace App\Http\Services\Product;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;//import cho Session và flash
use Illuminate\Support\Facades\Storage;




class UploadService
{
    public function uploadImage(Request $request, $product = null)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->storeAs('public/image/products', $image->getClientOriginalName());

            // Nếu là thêm mới sản phẩm, tạo mới đối tượng Product
            // Nếu là cập nhật, sử dụng đối tượng đã truyền vào
            $product = $product ?: new Product();

            // Lưu tên file vào cột thumb
            $product->thumb = $image->getClientOriginalName();
            $product->save();

            return asset("storage/image/products/{$product->thumb}");   
        }

        return null;
    }

    //load san pham lan 1
    const LIMIT=12  ; 
    public function get()
    {
        return Product::select('id','name','price','price_sale','thumb')
            ->orderByDesc('id')
            ->limit(self::LIMIT)
            ->get();
    }

}

