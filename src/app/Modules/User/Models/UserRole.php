<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'model_has_roles';

    protected $attributes = [
        'model_type' => 'App\Modules\Authentication\Models\User',
    ];
}
