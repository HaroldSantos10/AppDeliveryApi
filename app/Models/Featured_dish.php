<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Featured_dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'featured_id',
        'dish_id',
    ];

    static $rules = [
        'featured_id' => 'required|exists:featureds,id',
        'dish_id' => 'required|exists:dishes,id',
        
    ];

    //
    public function featured(){
        return $this->belongsTo(Featured::class);
    }

    public function dish(){
        return $this->belongsTo(Dish::class);
    }
}
