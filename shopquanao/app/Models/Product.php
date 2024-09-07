<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
'id',
'category_id',
'brand_id',
'name',
'slug',
'detail',
'description',
'image',
'price',
'pricesale',
'sale_end_date',
'size',
'qty',
'created_at',
'updated_at',
'created_by',
'updated_by',
'status',];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function productimags()
{
    return $this->hasMany(Productimag::class);
}
public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
