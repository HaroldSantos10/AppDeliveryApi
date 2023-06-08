<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'restaurant_id',

    ];

    static $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'restaurant_id' => 'required|integer',

    ];

    //Each featured belongs to a restaurant
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    //indicates that have more than one featureds_dishes
    public function featured_dish(){
        return $this->hasMany(Featured_dish::class);
    }
}
