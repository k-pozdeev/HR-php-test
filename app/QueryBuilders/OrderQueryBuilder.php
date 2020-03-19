<?php

namespace App\QueryBuilders;

use App\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderQueryBuilder extends Builder
{
    public function whereOverdued(): self {
        $now = new \DateTime();
        $this->where('orders.delivery_dt', '<', $now)
            ->where('orders.status', '=', Order::STATUS_APPROVED);
        return $this;
    }

    public function whereActive(): self {
        $now = new \DateTime();
        $this->where('orders.delivery_dt', '<=', $now->add(new \DateInterval("PT24H")))
            ->where('orders.status', '=', Order::STATUS_APPROVED);
        return $this;
    }

    public function whereNew(): self {
        $now = new \DateTime();
        $this->where('orders.delivery_dt', '>', $now)
            ->where('orders.status', '=', Order::STATUS_NEW);
        return $this;
    }

    public function whereComplete(): self {
        $now = new \DateTime();
        $dayEnd = $now->setTime(23, 59, 59);
        $this->where('orders.delivery_dt', '<=', $dayEnd)
            ->where('orders.status', '=', Order::STATUS_COMPLETE);
        return $this;
    }
}