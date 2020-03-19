<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $vendor_id
 * @property string $name
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 * @property Vendor $vendor
 * @property OrderProduct[] $orderProducts
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['vendor_id', 'name', 'price', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
