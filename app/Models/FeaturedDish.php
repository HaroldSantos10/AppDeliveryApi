<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FeaturedDish
 *
 * @property $featured_id
 * @property $dish_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Dish $dish
 * @property Featured $featured
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FeaturedDish extends Model
{
    
    static $rules = [
		'featured_id' => 'required',
		'dish_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['featured_id','dish_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dish()
    {
        return $this->hasOne('App\Models\Dish', 'id', 'dish_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function featured()
    {
        return $this->hasOne('App\Models\Featured', 'id', 'featured_id');
    }
    

}
