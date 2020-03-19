<?php

namespace App;

use App\QueryBuilders\OrderQueryBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property int $id
 * @property int $status
 * @property string $client_email
 * @property int $partner_id
 * @property string $delivery_dt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderProduct[] $orderProducts
 * @property-read int|null $order_products_count
 * @property-read \App\Partner $partner
 * @method static \App\QueryBuilders\OrderQueryBuilder|\App\Order newModelQuery()
 * @method static \App\QueryBuilders\OrderQueryBuilder|\App\Order newQuery()
 * @method static \App\QueryBuilders\OrderQueryBuilder|\App\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereClientEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeliveryDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    const STATUS_NEW = 0;
    const STATUS_APPROVED = 10;
    const STATUS_COMPLETE = 20;
    const STATUS_LABELS = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_APPROVED => 'Подтвержденный',
        self::STATUS_COMPLETE => 'Завершенный'
    ];

    /**
     * @var array
     */
    protected $fillable = ['partner_id', 'status', 'client_email', 'delivery_dt', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function newEloquentBuilder($query)
    {
        return new OrderQueryBuilder($query);
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($this->orderProducts as $orderProduct) {
            $total += $orderProduct->price * $orderProduct->quantity;
        }
        return $total;
    }
}
