<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable=['name','description','status','image','slug','parent_id','created_at','updated_at','creates_by'];
  
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function products()
{
    return $this->hasMany(Product::class);
}
}
