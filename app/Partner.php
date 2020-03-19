<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Order[] $orders
 */
class Partner extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['email', 'name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
