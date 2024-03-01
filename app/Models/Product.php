<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table ='products';

    protected $fillable =[
        
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'thumb',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

}
