<?php

namespace App\Modules\Customer\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CanFilterByAdmin
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            'Spatie\Permission\Models\Role',
            'App\Modules\User\Models\UserRole',
            'model_id',
            'role_id'
        );
    }

    public function scopeFilterByAdminRole(Builder $query): Builder
    {
        return $query->with('roles')->whereHas('roles', function($qry){
            $qry->where('name', 'Admin');
        });
    }
}
