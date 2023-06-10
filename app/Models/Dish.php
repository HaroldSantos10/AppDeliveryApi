<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'image',
        'restaurant_id',
    ];

    static $rules = [
        'name' => 'required|string|min:3',
        'description' => 'required|string|min:10',
        'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0',
        'image' => 'required|image|',
        'restaurant_id' => 'required',

    ];

    //Each dish belongs to a restaurant
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    //indicates that have more than one featureds_dishes
    public function featured_dish(){
        return $this->hasMany(Featured_dish::class);
    }
}
