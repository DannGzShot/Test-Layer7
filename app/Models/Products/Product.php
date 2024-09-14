<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 
        'name', 
        'description', 
        'quantity', 
        'max_quantity', 
        'min_quantity', 
        'price', 
        'img',
        'created_by', 
        'modify_by',
        'deleted_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function modify_by()
    {
        return $this->belongsTo('App\Models\User', 'modify_by');
    }

    public function deleted_by()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by');
    }


    public function products()
    {
       
         $query = Product::with(['created_by']);
        return $query;
    }

}
