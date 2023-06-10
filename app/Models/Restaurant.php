<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'lng',
        'lat',
        'address',
        'stars',
        'reviews',
        'category_id',

    ];

    static $rules = [
        'name' => 'required|string|min:3',
        'image' => 'required|image',
        'description' => 'required|string|min:10',
        'lng' => ['required', 'regex:/^[-]?(([0-9]|[1-8][0-9])(\.[0-9]{1,15})?|90(\.0{1,15})?)$/'],
        'lat' => ['required', 'regex:/^[-]?(([0-9]|[1-8][0-9])(\.[0-9]{1,15})?|90(\.0{1,15})?)$/'],        
        'address' => 'required|string|',
        'stars' => 'required|integer|min:0|max:5',
        'reviews' => 'required|string|',
        'category_id' => 'required|integer|',

    ];

    //Each restaurant belongs to a category
    public function category(){
        return $this->belongsTo(Category::class);
    }


    //indicates that have more than one dish
    public function dishes(){
        return $this->hasMany(dishes::class);
    }


}
