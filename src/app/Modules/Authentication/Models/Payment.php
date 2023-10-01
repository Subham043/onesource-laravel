<?php

namespace App\Modules\Authentication\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'paid_by',
    ];

    protected $append = [
        'payment_statue',
        'payment_date',
        'payment_renewal_date'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function payee()
    {
        return $this->belongsTo(User::class, 'paid_by')->withDefault();
    }

    protected function paymentDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at,
        );
    }

    protected function paymentRenewalDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->addYear(1),
        );
    }

    protected function paymentStatus(): Attribute
    {
        $nowDate = Carbon::now();
        return Attribute::make(
            get: fn () => $nowDate->lte($this->payment_renewal_date),
        );
    }

}
