<?php

namespace App\Helpers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
class Helper
{

    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $Key => $menu) {
            if ($menu->parent_id == $parent_id) {
                
                $html .= '
                    <tr class="hover-effect">
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active)  . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/Apparel_Perfume_Shop/public/admin/menu/edit/' . $menu->id . '">
                                <i class="far fa-pen-to-square"></i>
                            </a> 

                            <a class="btn btn-danger btn-sm" href="#" data-id="' . $menu->id . '" data-url="' . url('/admin/menu/destroy') . '" onclick="removeRow(this)">
                                <i class="far fa-trash-can"></i>
                            </a>

                            
                        </td>
                    </tr>
                ';
                unset($menus[$Key]); // Xóa phần để qui

                $html .= self::menu($menus, $menu->id, $char . '--');
            }
        }
        return $html;
    }

    public static function active($active =0):string
    {
        return $active== 0? '<span class="btn btn-danger btn-xs">KHÔNG</span>' : '<span class="btn btn-success btn-xs">CÓ</span>';
    }

    #product
    public static function productList($products)
    {
        $html = '';

        foreach ($products as $product) {
            $menu = Menu::find($product->menu_id);

            $html .= '
                <tr class="hover-effect align-center" >
                    <td>' . $product->name . '</td>
                    <td>' . ($menu ? $menu->name : 'Unknown Category') . '</td>
                    <!--<td>' . $product->menu_id . '</td>-->
                    <td>' . $product->price . '</td>
                    <td>' . $product->price_sale . '</td>
                    <td>                     
                        
                       <img src="'. asset("image/products/$product->thumb") . '" alt="Product Image" width="50"> 
                       <!--<img src="' . "http://localhost/Apparel_Perfume_Shop/storage/app/public/image/products/anhnh3.png" . '" alt="Product Image" width="50">-->
                    </td>
                    <td>' . self::active($product->active) . '</td>
                    <td>
                            <a class="btn btn-primary btn-sm" href="' . route('products.edit', ['id' => $product->id]) . '">
                                <i class="far fa-pen-to-square"></i>
                            </a> 

                            <a class="btn btn-danger btn-sm" href="#" data-id="' . $product->id . '" data-url="' .  route('products.destroy', ['id' => $product->id])  . '" onclick="removeRowProduct(this)">
                                <i class="far fa-trash-can"></i>
                            </a>

                            
                </tr>
            ';  
        }

        return $html;
    }

    # slider
    public static function sliderList($sliders)
    {
        $html = '';

        foreach ($sliders as $slider) {

            $html .= '
                <tr class="hover-effect align-center" >
                    <td>' . $slider->name . '</td>
                    <td>' . $slider->url . '</td>
                    <td>                     
                        
                       <img src="'. asset("image/sliders/$slider->thumb") . '" alt="slider Image" width="100"> 
                    </td>
                    <td>' . self::active($slider->active) . '</td>
                    <td>' . $slider-> updated_at. '</td>
                    <td>
                            <a class="btn btn-primary btn-sm" href="' . route('sliders.edit', ['id' => $slider->id]) . '">
                                <i class="far fa-pen-to-square"></i>
                            </a> 

                            <a class="btn btn-danger btn-sm" href="#" data-id="' . $slider->id . '" data-url="' .  route('sliders.destroy', ['id' => $slider->id])  . '" onclick="removeRowSlider(this)">
                                <i class="far fa-trash-can"></i>
                            </a>                  
                </tr>
            ';  
        }

        return $html;
    }

    // load dữ liệu của menus   
    public static function menus($data, $parent_id=0)
    {
        $menu_html = '';
        foreach ($data as $menu) {
            if ($menu->parent_id == $parent_id) {
                $menu_html .= '<li>';
                $menu_html .= '<a href="' . $menu->url . '">' . $menu->name . '</a>';
                
                // Kiểm tra xem có menu con hay không
                $children = Menu::where('parent_id', $menu->id)->get();
                if ($children->isNotEmpty()) {
                    $menu_html .= '<ul class="sub-menu">';
                    $menu_html .= self::menus($children, $menu->id); // Gọi đệ quy để xử lý menu con
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;
    }

    //lấy giá của sản phẩm
    public static function price($price=0, $priceSale=0)
    {
        if($priceSale !=0 ) return number_format($priceSale) ;
        if($price !=0) return number_format($price) ;
        return '<a href="/lien-he.html">Liên Hệ</a>';
    }

}
