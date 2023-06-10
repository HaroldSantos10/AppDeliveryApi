<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Restaurant;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'image', 

    ];

    static $rules =[
        'name' => 'required|string|min:3',
        'image' => 'required|image',  
    ];

    //indicates that have more than one restaurant
    public function restaurant(){
        return $this->hasMany(Restaurant::class);
    }

}
