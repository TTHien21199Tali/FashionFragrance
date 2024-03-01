<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\slider;
use Illuminate\Support\Facades\Session;



class SliderController extends Controller
{
    //
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider =$slider;
    }

    public function index()
    {
        //
        $sliders = Slider::all(); // Lấy danh sách sản phẩm
        

        return view('admin.slider.list', [
            'title'=>'Danh Sách hình ảnh',
            'sliders' => $sliders]);
    }

    public function create()
    {
        return view('admin.slider.add',[
            'title'=>'Thêm Slider mới'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'url' => 'required',
                'sort_by' => 'nullable|numeric|min:0',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'active' => 'required|in:0,1',
            ], [
                'name.required' => 'Tiêu đề không được để trống.',
                'url.required' => 'Đường dẫn không được để trống.',
                'sort_by.numeric' => 'Sắp xếp phải là số.',
                'sort_by.min' => 'Sắp xếp phải lớn hơn hoặc bằng 0.',
                'file.image' => 'Ảnh slider phải là hình ảnh.',
                'file.mimes' => 'Định dạng ảnh không hợp lệ.',
                'file.max' => 'Kích thước ảnh quá lớn.',
                'active.required' => 'Trạng thái kích hoạt không được để trống.',
                'active.in' => 'Trạng thái kích hoạt không hợp lệ.',
            ]);

            $this->slider->createSlider($request);

            Session::flash('success', 'Thêm slider thành công');
            return redirect()->route('sliders.create');

        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(string $id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            // Xử lý khi không tìm thấy slider
        }

        return view('admin.slider.edit', [
            'title' => 'Chỉnh Sửa hình ảnh: ' . $slider->name,
            'slider' => $slider, // Truyền thông tin slider vào view
        ]);
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'url' => 'required',
                'sort_by' => 'nullable|numeric|min:0',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'active' => 'required|in:0,1',
            ], [
                'name.required' => 'Tiêu đề không được để trống.',
                'url.required' => 'Đường dẫn không được để trống.',
                'sort_by.numeric' => 'Sắp xếp phải là số.',
                'sort_by.min' => 'Sắp xếp phải lớn hơn hoặc bằng 0.',
                'file.image' => 'Ảnh slider phải là hình ảnh.',
                'file.mimes' => 'Định dạng ảnh không hợp lệ.',
                'file.max' => 'Kích thước ảnh quá lớn.',
                'active.required' => 'Trạng thái kích hoạt không được để trống.',
                'active.in' => 'Trạng thái kích hoạt không hợp lệ.',
            ]);

            $slider = Slider::find($id);

            if ($slider) {
                $slider->name = $request->input('name');
                $slider->url = $request->input('url');
                $slider->sort_by = $request->input('sort_by');
                $slider->active = $request->input('active');

                // Nếu người dùng tải lên hình ảnh mới
                if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    //$path = $image->storeAs('public/image/sliders', $image->getClientOriginalName());
                    $slider->thumb = $image->getClientOriginalName();
                }

                $slider->save();

                Session::flash('success', 'Cập nhật slider thành công');
                return redirect()->route('sliders.index');
            } else {
                // Xử lý khi không tìm thấy slider
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy(string $id)
    {
        $slider = Slider::find($id);

        if ($slider) {
            $slider->delete();
            return response()->json(['error' => false, 'message' => 'Xóa hình ảnh thành công']);
        } else {
            return response()->json(['error' => true, 'message' => 'Không tìm thấy hình ảnh']);
        }       
    }
}
