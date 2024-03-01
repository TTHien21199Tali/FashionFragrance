<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Product\UploadService;

use App\Models\Slider;

class MainController extends Controller
{
    //
    protected $slider;
    protected $menu; //biến phục vụ cho trang chủ
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu, UploadService $product )
    {
        $this->slider=$slider;
        $this->menu=$menu;
        $this->product=$product;
    }

    public function index(){
        return view('main',[
            'title'=>'Shop Nước Hoa',
            'sliders'=>$this->slider->show(),
            'menus'=>$this->menu->show(),
            'products'=>$this->product->get()
        ]);
    }
}
