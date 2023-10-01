<?php

namespace App\Modules\Customer\Models;

use App\Modules\Authentication\Models\Profile;
use App\Modules\Authentication\Models\User;
use App\Modules\Customer\Traits\CanFilterByAdmin;
use App\Modules\Customer\Traits\CanFilterByPayment;
use Illuminate\Database\Eloquent\Builder;

class Customer extends User
{
    use CanFilterByAdmin, CanFilterByPayment;

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id')->whereColumn('user_id', 'created_by');
    }

    public function scopeWithProfile(Builder $query): Builder
    {
        return $query->with('profile');
    }
}
