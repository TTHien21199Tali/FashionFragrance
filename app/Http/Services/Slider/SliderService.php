<?php

namespace App\Http\Services\Slider;
use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;//import cho Session và flash
use Illuminate\Support\Facades\Storage;



class SliderService
{
    public function createSlider(Request $request)
    {
        $slider = new Slider();

        $slider->name = $request->input('name');
        $slider->url = $request->input('url');
        $slider->sort_by = $request->input('sort_by');
        $slider->active = $request->input('active');

        // Upload image
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->storeAs('public/image/sliders', $image->getClientOriginalName());// thêm
            $slider->thumb = $image->getClientOriginalName();
        }

        $slider->save();
    }

    public function show()
    {
        return Slider::select('name','id','thumb','sort_by')
        ->where('active',1)
        ->orderbyDesc('sort_by')
        ->get();
    }

    /*public function uploadImage(Request $request, $product = null)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->storeAs('public/image/products', $image->getClientOriginalName());

            // Nếu là thêm mới sản phẩm, tạo mới đối tượng Product
            // Nếu là cập nhật, sử dụng đối tượng đã truyền vào
            $product = $product ?: new Slider();

            // Lưu tên file vào cột thumb
            $product->thumb = $image->getClientOriginalName();
            $product->save();

            return asset("storage/image/products/{$product->thumb}");   
        }

        return null;
    }*/
}