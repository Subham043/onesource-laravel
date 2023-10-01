<?php

namespace App\Modules\Customer\Traits;

use App\Modules\Authentication\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait CanFilterByPayment
{
    public function currentPayment(): HasOne
    {
        return $this->hasOne(Payment::class, 'paid_by')->latest();
    }

    public function scopeFilterByCurrentPayment(Builder $query): Builder
    {
        return $query->with('currentPayment');
    }
}
